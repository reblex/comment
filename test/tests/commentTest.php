<?php
namespace reblex\Comment;

use PHPUnit\Framework\TestCase;

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
}
