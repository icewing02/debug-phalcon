<?php
$loader = new \Phalcon\Loader();
$loader->registerDirs(array(
		__DIR__ . '/models/'
	))->register();

$di = new \Phalcon\DI\FactoryDefault();
$di->set('db', function(){
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => "localhost",
        "username" => "some_username",
        "password" => "some_password",
        "dbname" => "some_database"
    ));
});

$app = new \Phalcon\Mvc\Micro($di);

/**
 * List all routing configuration here.
 */

// get list of students
$app->get('/api/students', function() use ($app) {
	$phql = "SELECT * FROM Students ORDER BY name";
    $students = $app->modelsManager->executeQuery($phql);
	$data = array();
    
    foreach($students as $student) {
        $data[] = array(
            'id' => $student->id,
            'name' => $student->name,
            'email' => $student->email,
        );
    }

    echo json_encode($data);
});

/**
 * Enable this for custom view. Set here for rerouting 404 error page.
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});

$app->handle();