
<?php
	class Presenter {
		
		private $_TemplateContent; 
		private $_parameters; 
		private $_templates; 
		private $_find; 
		private $_replace; 
		
		function __construct () {
			$this->_TemplateContent = '';
			$this->_parameters = array(); 
			$this->_templates = array(); 
			$this->_find = array(); 
			$this->_replace = array(); 
		}
		
		function AddParameter ($key, $value) {
			$this->_parameters [$key] = $value; 
		}		
		
		function AddTemplate ($template) {
			array_push($this->_templates, $template); 
		}
		
		function FindReplace ($find,$replace) {
			array_push($this->_find, $find); 
			array_push($this->_replace, $replace); 
		}
		
		function Parameter($key) {
			if($this->_parameters[$key]) {
				return $this->_parameters[$key]; 
			} else {
				return false; 
			}
		}
		
		function Parameters () {
			return $this->_parameters; 
		}
		
		function Templates () {
			return $this->_templates; 
		}
		
		function Publish ($arrayFind = '',$arrayReplace = '') {
			foreach($this->Parameters() as $variable => $value) {
				$$variable = $value;
			}
			
			foreach($this->Templates() as $template) {
				ob_start();
				$include_path = 'templates/' . $template . '.html.php';
				include($include_path);
				$this->_TemplateContent .= ob_get_contents();
				ob_end_clean();
			}
			
			$this->_TemplateContent = str_replace($this->_find,$this->_replace,$this->_TemplateContent);
			echo $this->_TemplateContent;
		}
		
	}
