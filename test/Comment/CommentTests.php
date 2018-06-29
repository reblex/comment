<?php
namespace reblex\Comment;

use PHPUnit\Framework\TestCase;
use \Anax\Comment\HTMLForm\CreateCommentForm;
use \Anax\Comment\HTMLForm\EditCommentForm;
use \reblex\User\User;
use \reblex\Comment\Comment;
use \reblex\Comment\CommentController;

final class CommentTest extends TestCase
{

    protected static $di;

    public function setUp()
    {
        $diConfig = __DIR__ . "/../di-config.php";
        self::$di = new \Anax\DI\DIFactoryConfig($diConfig);
    }

    public function testCommentHasCorrectContent(): void
    {
        $comment = new Comment();
        $comment->setDb(self::$di->get("db"));
        $comment->find("id", 1);

        $this->assertEquals(
            "Hejsan svejsan.",
            $comment->content
        );
    }

    public function testCreateCommentFormGetHTML()
    {
        $user = new User();
        $user->setDb(self::$di->get("db"));
        $user->findById(1);

        $form = new CreateCommentForm(self::$di, $user);
        $formHTML = $form->getHTML();
        $this->assertEquals(is_string($formHTML), true);
    }

    public function testEditCommentFormGetHTML()
    {
        $comment = new Comment();
        $comment->setDb(self::$di->get("db"));
        $comment->find("id", 1);

        $form = new EditCommentForm(self::$di, $comment);
        $formHTML = $form->getHTML();
        $this->assertEquals(is_string($formHTML), true);
    }

    public function testCheckUserPassoword()
    {
        $user = new User();
        $user->setDb(self::$di->get("db"));
        $user->find("id", 1);

        $res = $user->verifyPassword("user", "user");

        $this->assertEquals($res, true);
    }

    public function testChangeUserPassoword()
    {
        $user = new User();
        $user->setDb(self::$di->get("db"));
        $user->find("id", 1);

        $user->setPassword("new");
        $user->save();

        $res = $user->verifyPassword("user", "new");

        $this->assertEquals($res, true);
    }
}
