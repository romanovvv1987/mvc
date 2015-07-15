<?php
	use Core\Controller;

	/**
	 * Class Controller_Index
	 */
	class Index_Controller extends Controller
	{

		function action_index() {
			$select = array(
				'limit' => 1
			);

			$model = new Models\Messages($select);
			$data  = $model->getAllRows();


			$this->view->generate('index', array('data' => $data));

		}

		/**
		 * Next news
		 * @return array
		 */
		function action_getdata() {

			$start    = ($start = intval($_POST['start'])) ? $start : 1;
			$messages = array();

			$select = array(
				'limit' => 1,
				'where' => 'id >=' . $start,
			);

			$model = new Models\Messages($select);
			$data  = $model->getAllRows();

			if (empty($data))
				return $messages;

			foreach ($data as $v) {
				$messages[] = array(
					'id'   => $v['id'],
					'text' => $v['text']
				);
			}


			echo json_encode($messages);

		}


	}