<?php


namespace backend\models;


class Post extends \yii\base\BaseObject
{
	private $_title;

	public function getTitle()
	{
		return $this->_title;
	}

	public function setTitle($value)
	{
		$this->_title = trim($value);
	}
}
