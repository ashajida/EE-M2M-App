<?php

require_once __DIR__ . '/models/CircuitBoardDbh.php';

/**
 * Controls a 'view statuses' action.
 * @author Michael
 */
final class StatusesController 
{
	/**
	 * Creates a new {@link StatusesController}.
	 * @param $model StatusesModel The model.
	 */
	public function __construct($container)
	{
		
	}

	/**
	 * Fetches the statuses of the circuit boards from the database.
	 * @throws Exception If a query fails to execute.
	 */
	public function fetchStatuses() {

		$boards = $this->CircuitBoardDhb->queryAllBoardInformation();

		foreach($boards as $board) {
			$msisdn = $board->getMSISDN();
			$status = null;

			try {
				$status = $database->queryBoardStatus($msisdn);
			} catch (Exception $e) {
				/* failed to find its status */
			}

			$this->model->addBoard(new CircuitBoard($board, $status));
		}
	}
}
