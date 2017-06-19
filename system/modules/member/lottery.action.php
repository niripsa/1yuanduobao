<?php
System::load_app_class("UserAction", "common", "no");
class lottery extends UserAction{
	public function lottery_index(){
		$this->view->show("user.lottery_index");
	}
}