<?php

/*
** [type] file
** [name] Language.php
** [author] Wim Paulussen
** [since] 2007-05-21
** [update] 2007-05-21
** [todo] <none>
** [end]
*/

/*
** [class] Language
** [extend] Session
*/

class Language extends Session
{
	/* 
	** [type] attribute
	** [name] file
	** [scope] private
	** [expl]
	** [end]
	*/
	private $file;
	/* 
	** [type] attribute
	** [name] lang
	** [scope] private
	** [expl]
	** [end]
	*/
	private $lang;

	/*
	** [type] method
	** [name] __construct
	** [scope] global
	** [expl] sets file and language 
	** [end]
	*/
	function __construct($file,$lang)
	{
		$this->file = $file;
		$this->lang = $lang;
	}
	
	/*
	** [type] method
	** [name] getText
	** [scope] public
	** [expl] returns array with text fields 
	** [end]
	*/
	public function getText()
	{
		// NOTE: get text for given parameters
		if( !$xml	= simplexml_load_file('./xml/psalang.xml'))
		{
			die('cannot read language file');
		}
		$this->ar = array();
		foreach ($xml->xpath('//file') as $file) 
		{
			// DEBUG: echo $file['id'];
			if($file['id'] == $this->file)
			{
				foreach($file->item as $item)
				{
					foreach($item->lang as $lang)
					{
						if((string)$lang['id'] == $this->lang)
						{
							$field = (string)$item['id'];
							$content = (string)$lang;
							$this->ar[$field] = $content;
						}
					}
				}
			}
		}
		return $this->ar;
	}
}

?>