<?php
/**
 * Configuration file for DI container.
 */

return [

    // Services to add to the container.
    "services" => [
        "request" => [
            "shared" => true,
            "callback" => function () {
                $request = new \Anax\Request\Request();
                $request->init();
                return $request;
            }
        ],
        "response" => [
            "shared" => true,
            // "callback" => "\Anax\Response\Response",
            "callback" => function () {
                $obj = new \Anax\Response\ResponseUtility();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "url" => [
            "shared" => true,
            "callback" => function () {
                $url = new \Anax\Url\Url();
                $request = $this->get("request");
                $url->setSiteUrl($request->getSiteUrl());
                $url->setBaseUrl($request->getBaseUrl());
                $url->setStaticSiteUrl($request->getSiteUrl());
                $url->setStaticBaseUrl($request->getBaseUrl());
                $url->setScriptName($request->getScriptName());
                $url->configure("url.php");
                $url->setDefaultsFromConfiguration();
                return $url;
            }
        ],
        "router" => [
            "shared" => true,
            "callback" => function () {
                $router = new \Anax\Route\Router();
                $router->setDI($this);
                $router->configure("route2.php");
                return $router;
            }
        ],
        "view" => [
            "shared" => true,
            "callback" => function () {
                $view = new \Anax\View\ViewCollection();
                $view->setDI($this);
                $view->configure("view.php");
                return $view;
            }
        ],
        "viewRenderFile" => [
            "shared" => true,
            "callback" => function () {
                $viewRender = new \Anax\View\ViewRenderFile2();
                $viewRender->setDI($this);
                return $viewRender;
            }
        ],
        "session" => [
            "shared" => true,
            "active" => true,
            "callback" => function () {
                $session = new \Anax\Session\SessionConfigurable();
                // $session->configure("session.php");
                $session->start();
                return $session;
            }
        ],
        "textfilter" => [
            "shared" => true,
            "callback" => "\Anax\TextFilter\TextFilter",
        ],
        "errorController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\ErrorController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "debugController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\DebugController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "flatFileContentController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\FlatFileContentController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "pageRender" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\PageRender();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "commentController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new reblex\Comment\CommentController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "db" => [
            "shared" => true,
            "callback" => function () {
                $obj = new Anax\Database\DatabaseQueryBuilder();

                $obj->configure([
                    "dsn"             => "sqlite:" . __DIR__ . "/db.sqlite",
                    "username"        => null,
                    "password"        => null,
                    "driver_options"  => null,
                    "fetch_mode"      => \PDO::FETCH_OBJ,
                    "table_prefix"    => null,
                    "session_key"     => "Anax\Database",
                    "verbose"         => null,
                    "debug_connect"   => true
                    ]);

                $obj->connect();

                $sql = 'DROP TABLE IF EXISTS `comments`;';
                $obj->execute($sql);

                $sql = 'CREATE TABLE `comments`
                (
                    `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    `userId` INT NOT NULL,
                    `datetime` DATETIME,
                    `content` VARCHAR(800)
                );';
                $obj->execute($sql);

                $sql = 'DELETE FROM `comments`;';
                $obj->execute($sql);

                $sql = 'INSERT INTO `comments` (`userId`, `content`) VALUES
                    (1, "Hejsan svejsan."),
                    (2, "Jag gillar bord.")
                ;';
                $obj->execute($sql);

                return $obj;
            }
        ],
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \reblex\User\UserController();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
