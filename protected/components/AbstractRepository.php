<?php

/**
 * Базовый класс для обозначения структуры репозитория
 */
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ExceptionInterface;
use Zend\Db\Sql\Sql;

abstract class AbstractRepository {

    protected $entityClass;
    protected $adapter;

    public function setEntityClass($entityClass) {
        $this->entityClass = $entityClass;
    }

	public function __construct($config = [], $entityClass = null) {

		if(is_null(Yii::app()->params->zend['adapter'])) {
			$this->initConnection($config);
		}
		
		if(!is_null($entityClass)) {
			$this->setEntityClass($entityClass);
		}

	}

	public function initConnection($dbSettings = []) {

		if(empty($dbSettings)) {
            trigger_error('Database settings is not be empty');
		}

        try {
			$adapter = new Adapter([
                    'driver' =>   $dbSettings['driver'],
                    'database' => $dbSettings['database'],
                    'username' => $dbSettings['username'],
                    'password' => $dbSettings['password'],
                    'hostname' => $dbSettings['hostname'],
                    'charset' =>  $dbSettings['charset']
            ]);

        } catch (ExceptionInterface $e) {
            trigger_error($e->getPrevious() ? $e->getPrevious()->getMessage() : $e->getMessage());
        } catch (\Exception $e) {
            trigger_error($e->getMessage());
        }              	
		
		Yii::app()->setParams([
			'zend'=> [
				'adapter'=>$adapter
			]
		]);
	}


    /**
     *  @return instance of Abstract_RepositoryResult extends ArrayObject
     *  @description основной метод выборки и трансформации в объекты
     * 
     *  string  @$params['class']   - имя класса элемента
     *  array   @$params['table']   - таблица
     *  array   @$params['field']   - заполняемые свойства
     *  integer @$params['offset']  - от 
     *  integer @$params['limit']   - до
     *  array   @$params['where']   - условия выборки
     *  array   @$params['order']   - сортировки полей
     *  array   @$params['like']    - похожести
     *  array   @$params['join']    - связи с другими таблицами
     * */
    public function findAll($params = []) {
        $time_start = microtime(true);

        $return = new \ArrayObject;
        $select = null;

        try {
            if (!empty($params['table'])) {

                $sql = new Sql(Yii::app()->params->zend['adapter']);

                $select = $sql->select();
                $select->from($params['table']);

                if (!empty($params['where']))
                    $select->where($params['where']);

                if (!empty($params['field']))
                    $select->columns($params['field']);

                if (!empty($params['offset']))
                    $select->offset($params['offset']);

                if (!empty($params['limit']))
                    $select->limit($params['limit']);

                if (!empty($params['order']))
                    $select->order($params['order']);

                if (!empty($params['like']))
                    $select->like($params['like']);

                if (!empty($params['join'])) {
                    foreach ($params['join'] as $join) {
                        if (!empty($join[0]) && is_array($join[0]) && !empty($join[1]) && is_string($join[1])) {

                            if (!empty($join[2]))
                                $select->join($join[0], $join[1], $join[2]);
                            else
                                $select->join($join[0], $join[1]);
                        }
                    }
                }

                $statement = $sql->prepareStatementForSqlObject($select);
                $results = $statement->execute();

                do {

                    $row = $results->current();

                    if (!empty($this->entityClass) || !empty($params['class'])) {

                        if ((!empty($params['class']) && class_exists($params['class'])) || class_exists($this->entityClass)) {
                            // класс объектов по умолчанию в $params['class']
                            $class_object = empty($params['class']) ? $this->entityClass : $params['class'];
                            $entitie = new $class_object;


                            if (!empty($row) && $class_object::getAbstractClass() == 'AbstractItem') {

                                $entitie->copyFromArray($row);

                                // возвращаем массив объектов
                                $return['items'][] = $entitie;
                            }
                        } else {
                            trigger_error(sprintf('Class "%s" not exists', $params['class'] ? $params['class'] : $this->entityClass));
                        }
                    } else {
                        $obj = new stdClass();

                        foreach ($row as $key => $value) {
                            $obj->{$key} = $value;
                        }

                        // возвращаем массив стандартных объектов
                        $return[] = $obj;
                    }
                } while ($results->next());

                unset($results, $select);
            }
        } catch (PDOException $e) {
            trigger_error(
                $e->getPrevious() ? $e->getPrevious()->getMessage() : $e->getMessage()
            );
        } catch (\Exception $e) {
            trigger_error($e->getMessage());
        }

        $time_end = microtime(true);
        $return['request-time'] = $time_end - $time_start;

        return $return;
    }

}
