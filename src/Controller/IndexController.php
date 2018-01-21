<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 18.04.2017
 * Time: 14:56
 */

namespace Controller;

use Doctrine\ORM\Query\ResultSetMapping;
use \Entities\Book;
use PHPUnit\Framework\Exception;

class IndexController extends ABaseController {

	/**
	 * List all Books
	 */
	protected function indexAction() {
		$em = $this->getEntityManager();
		$books = $em->getRepository('Entities\\Book')->findAll();
		$this->addContext('books', $books);
	}

	/**
	 * Shows a single Book
	 */
	protected function showAction() {
		$em = $this->getEntityManager();
		$book = $em->find('Entities\\Book', $_GET['id']);
		$this->addContext('book', $book);
	}

	/**
	 * Adds a new Book
	 */
	protected function newAction() {
		$book = new Book();
		$em = $this->getEntityManager();
		if ($_POST) {
			$book->setData($_POST);
			$em->persist($book);
			$em->flush();
			redirect('index.php');
		}

		$this->addContext('book', $book);
		$this->setTemplate('persist');
	}

	/**
	 * Edits a book
	 */
	protected function editAction() {
		$em = $this->getEntityManager();
		$book = $em->find('Entities\\Book', $_REQUEST['id']);
		if ($_POST) {
			$book->setData($_POST);
			$em->persist($book);
			$em->flush();
			redirect('index.php');
		}

		$this->addContext('book', $book);
		$this->setTemplate('persist');
	}

	/**
	 * Deletes an existing book
	 */
	protected function delAction() {
		$em = $this->getEntityManager();
		$book = $em->find('Entities\\Book', $_GET['id']);
		if($book) {
			$em->remove($book);
			$em->flush();
		}
		redirect('index.php');
	}

	/**
	 * Searches all books by an ID range
	 */
	protected function searchAction() {
		$em = $this->getEntityManager();
		$query = $em->createQuery('SELECT b FROM Entities\Book b WHERE b.id >= :id_start AND b.id <= :id_end');
		$query = $em->createQueryBuilder()
			->select('b')
			->from('Entities\Book', 'b')
			->where('b.id >= :id_start')
			->andWhere('b.id <= :id_end')
			->orderBy('b.title', 'DESC')
			->getQuery()
		;
		$ids = [
			'id_start' => 1,
			'id_end' => 3
		];
		$query->setParameters($ids);
		$books = $query->getResult();
		$this->setTemplate('index');
		$this->addContext('books', $books);
	}
}