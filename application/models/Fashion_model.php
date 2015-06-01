<?php
use predictionio\EventClient;
use predictionio\EngineClient;

class Fashion_model extends Fit_Model {

	function getAttributes()
	{
		require_once("application/libraries/Attribute.php");

		$attributes = array(
			new Attribute('gender_id', '성별', $this->db->get('Gender')->result()),
			new Attribute('season_id', '시즌', $this->db->get('Season')->result()),
			new Attribute('style_id', '스타일', $this->db->get('Style')->result()),
			new Attribute('age_id', '나이', $this->db->get('Age')->result())
			);

		return $attributes;
	}

	function getClass()
	{
		return $this->db->get('Class')->result();
	}

	function getItemTypeByClass() {
		$classes = $this->db->select('id')->get('Class')->result();
		foreach ($classes as $class) {
			$result[$class->id] = $this->db->get_where('ItemType', array('class_id' => $class->id))->result();
		}

		return $result;
	}

	function getItemType() {
		return $this->db->get('ItemType')->result();
	}

	function getColor() {
		return $this->db->get('Color')->result();
	}

	function getPattern() {
		return $this->db->get('Pattern')->result();
	}

	function add($data) {
		foreach ($data as $key => $token) {
			if ($token->name != 'items')
				$fashionTuple[$token->name] = $token->value;
			else
				$itemTuples = $token->value;
		}

		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('Fashion', $fashionTuple);

		$fashion_id = $this->db->insert_id();

		$this->load->helper('path');

		$file_name = $fashionTuple['editor_id'].'_'.$fashion_id.'.jpg';

		$relative_path = 'resource/itemImg/';
		$absolute_path = set_realpath($relative_path); 
		$destination_path = $absolute_path.$file_name;
		copy($fashionTuple['img_path'], $destination_path);

		$this->db->where('id', $fashion_id);
		$this->db->update('Fashion', array('img_path' => $relative_path.$file_name));

		foreach ($itemTuples as $key => $itemTuple) {
			$this->db->set('fashion_id', $fashion_id);
			$this->db->insert('Item', $itemTuple);
		}

		$client = new EventClient($this->accessKey, $this->eventServerURL, 10, 10);
		$response = $client->setItem($fashion_id);
	}

	function getFashionById($fashion_id, $user_id = null) {
		if ($user_id == null) {
			$fashionTuple = $this->db
			->select('img_path, src_link, 
				Gender.label gender_label,
				first_name, last_name,
				Season.label season_label,
				Style.label style_label,
				Age.label age_label,
				Fashion.created_date created_date')
			->from('Fashion, User')
			->join('Gender', 'Gender.id = Fashion.gender_id')
			->join('Editor', 'Editor.id = Fashion.editor_id')
			->join('Season', 'Season.id = Fashion.season_id')
			->join('Style', 'Style.id = Fashion.style_id')
			->join('Age', 'Age.id = Fashion.age_id')
			->where('Fashion.id', $fashion_id)->get()->row();
		}
		else {
			$query = 'SELECT img_path, src_link, 
				Gender.label gender_label,
				first_name, last_name, email,
				Season.label season_label,
				Style.label style_label,
				Age.label age_label,
				Fashion.created_date created_date,
				Rates.type_id type_id,
				follower_id
				FROM Fashion
				JOIN Gender ON Gender.id = Fashion.gender_id
				JOIN Editor ON Editor.id = Fashion.editor_id
				JOIN User ON Editor.id = User.editor_id
				JOIN Season ON Season.id = Fashion.season_id
				JOIN Style ON Style.id = Fashion.style_id
				JOIN Age ON Age.id = Fashion.age_id
				LEFT OUTER JOIN (SELECT * FROM Follow WHERE follower_id = '.$this->db->escape($user_id).') Follows ON Follows.followed_id = email
				LEFT OUTER JOIN (SELECT * FROM Rate WHERE user_id = '.$this->db->escape($user_id).') Rates ON Fashion.id = Rates.fashion_id
				WHERE Fashion.id = '.$this->db->escape($fashion_id);
			$fashionTuple = $this->db->query($query)->row();
		}
		

		$itemTuples = $this->db->
		select('
			Class.label class_label,
			ItemType.label type_label,
			Color.label color_label,
			Pattern.label pattern_label')
		->from('Item')
		->join('ItemType', 'ItemType.id = Item.type_id')
		->join('Color', 'Color.id = Item.color_id')
		->join('Pattern', 'Pattern.id = Item.pattern_id')
		->join('Class', 'Class.id = ItemType.class_id')
		->where('Item.fashion_id', $fashion_id)->get()->result();

		$fashionTuple->img_path = base_url($fashionTuple->img_path);

		$commentTuples = $this->db->query('
			SELECT Comment.id, comment_text, Comment.user_id, Comment.created_date, User.nick_name, Likes.num_of_likes, UserLikes.user_id userLikes
			FROM Comment JOIN User ON User.email = Comment.user_id
			LEFT OUTER JOIN (SELECT COUNT(*) num_of_likes, comment_id FROM LikeComment GROUP BY comment_id) Likes ON Likes.comment_id = Comment.id
			LEFT OUTER JOIN (SELECT * FROM LikeComment WHERE LikeComment.user_id = '.$this->db->escape($user_id).') UserLikes ON UserLikes.comment_id = Comment.id
			WHERE fashion_id = '.$this->db->escape($fashion_id).' ORDER BY num_of_likes DESC, Comment.created_date DESC LIMIT 3')->result();
		
		$result = array(
			'fashion' => $fashionTuple,
			'items' => $itemTuples,
			'comments' => $commentTuples);

		return $result;
	}

	function get($editor_id = 0)
	{
		$query = $this->db
		->select('img_path, src_link, 
			Gender.label 성별,
			Season.label 시즌, 
			Style.label 스타일, 
			Age.label 나이')
		->from('Item')
		->join('Gender', 'Gender.id = Item.gender_id')
		->join('Season', 'Season.id = Item.season_id')
		->join('Style', 'Style.id = Item.style_id')
		->join('Age', 'Age.id = Item.age_id')
		->get();

		return $query->result();
	}

	function getCardData($email = null, $editor_id = 0)
	{
		if ($email != null) {
			$query = 'SELECT Fashion.id, img_path, Fashion.editor_id, first_name, last_name, Rates.type_id type_id
			FROM Fashion JOIN User ON User.editor_id = Fashion.editor_id
			LEFT OUTER JOIN (SELECT * FROM Rate WHERE user_id = '.$this->db->escape($email).') Rates ON Fashion.id = Rates.fashion_id';
			
			$result = $this->db->query($query)->result();
		}
		else {
			$result = $this->db
			->select('Fashion.id, img_path, Fashion.editor_id, first_name, last_name')
			->from('Fashion')
			->join('User', 'User.editor_id = Fashion.editor_id')
			->get()->result();	
		}

		foreach ($result as $row)
			$row->img_path = base_url($row->img_path);
		
		return $result;
	}

	function getRecommended($user_id) {
		$client = new EngineClient($this->engineServerURL, 10, 10);
		$response = $client->sendQuery(array('user' => $user_id, 'num' => 4));

		$recommended = $response['itemScores'];
		
		$query = 'SELECT Fashion.id, img_path, Fashion.editor_id, first_name, last_name, Rates.type_id type_id
			FROM Fashion JOIN User ON User.editor_id = Fashion.editor_id
			LEFT OUTER JOIN (SELECT * FROM Rate WHERE user_id = '.$this->db->escape($user_id).') Rates ON Fashion.id = Rates.fashion_id';

		if (count($recommended) == 0)
			return null;

		$query .= ' WHERE Fashion.id IN (';
		foreach ($recommended as $key => $item) {
			if ($key == 0) {
				$query .= $this->db->escape($item['item']);
			}
			$query .= ', '.$this->db->escape($item['item']);	
		}
		$query .= ')';
		$result = $this->db->query($query)->result();

		foreach ($result as $row)
			$row->img_path = base_url($row->img_path);
		
		return $result;		
	}

	function getFiltered($filters, $email) {
		$query = 'SELECT Fashion.id, img_path, Fashion.editor_id, first_name, last_name, Rates.type_id type_id
		FROM Fashion JOIN User ON User.editor_id = Fashion.editor_id
		LEFT OUTER JOIN (SELECT * FROM Rate WHERE user_id = '.$this->db->escape($email).') Rates ON Fashion.id = Rates.fashion_id';

		$subQuery = 'SELECT DISTINCT fashion_id FROM Item';

		foreach ($filters as $key => $filter) {
			$subQuery .= ($key == 0)? ' WHERE ' : ' OR ';

			$subQuery .= '(type_id='.$this->db->escape($filter->type_id);
			if (count($filter->colors) != 0) {
				$subQuery .= ' AND (';
				foreach ($filter->colors as $key => $color) {
					if ($key != 0) {
						$subQuery .= ' OR ';
					}
					$subQuery .= 'color_id='.$this->db->escape($color);
				}
				$subQuery .= ')';
			}
			if (count($filter->patterns) != 0) {
				$subQuery .= ' AND (';
				foreach ($filter->patterns as $key => $pattern) {
					if ($key != 0) {
						$subQuery .= ' OR ';
					}
					$subQuery .= 'pattern_id='.$this->db->escape($pattern);
				}
				$subQuery .= ')';
			}
			$subQuery .= ')';
		}

		$query .= ' WHERE Fashion.id IN ('.$subQuery.')';

		$result = $this->db->query($query)->result();
		foreach ($result as $row)
			$row->img_path = base_url($row->img_path);
		
		return $result;
	}

	function getRated($email) {
		$query = 'SELECT Fashion.id, img_path, Fashion.editor_id, first_name, last_name, Rates.type_id type_id
			FROM Fashion JOIN User ON User.editor_id = Fashion.editor_id
			JOIN (SELECT * FROM Rate WHERE user_id = '.$this->db->escape($email).' AND type_id != 1) Rates ON Fashion.id = Rates.fashion_id';
			
		$result = $this->db->query($query)->result();
		foreach ($result as $row)
			$row->img_path = base_url($row->img_path);

		return $result;
	}

	function getComments($fashion_id, $user_id) {
		$commentTuples = $this->db->query('
			SELECT Comment.id, comment_text, Comment.user_id, Comment.created_date, User.nick_name, Likes.num_of_likes, UserLikes.user_id userLikes
			FROM Comment JOIN User ON User.email = Comment.user_id
			LEFT OUTER JOIN (SELECT COUNT(*) num_of_likes, comment_id FROM LikeComment GROUP BY comment_id) Likes ON Likes.comment_id = Comment.id
			LEFT OUTER JOIN (SELECT * FROM LikeComment WHERE LikeComment.user_id = '.$this->db->escape($user_id).') UserLikes ON UserLikes.comment_id = Comment.id
			WHERE fashion_id = '.$this->db->escape($fashion_id).' ORDER BY num_of_likes DESC, Comment.created_date DESC')->result();

		return $commentTuples;
	}
}

?>
