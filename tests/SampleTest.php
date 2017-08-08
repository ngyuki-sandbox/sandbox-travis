<?php
/**
 * @author ngyuki
 */
class SampleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function test()
    {
        $host = getenv('MYSQL_HOST');
        $port = getenv('MYSQL_PORT');
        $dbname = getenv('MYSQL_DATABASE');
        $user = getenv('MYSQL_USER');
        $pass = getenv('MYSQL_PASSWORD');

        $pdo = new PDO("mysql:dbname=$dbname;host=$host;port=$port;charset=utf8", $user, $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );

        $pdo->query('drop table if exists t');
        $pdo->query('create table t (id int not null primary key)');
        $pdo->query('insert into t values (123)');
        $val = $pdo->query('select * from t')->fetchColumn();

        $this->assertEquals($val, 123);
    }
}
