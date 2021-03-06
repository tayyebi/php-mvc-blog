<?php

class Post extends Model {

    function GetHomePagePosts() {
        $Query = '
        SELECT * FROM (
        SELECT `Id`, `Title`, `Submit`, `Abstract`, `Type`, `FileName`
        FROM `Posts`
        WHERE `Type`=\'Card\'
        ORDER BY `Id`
        DESC LIMIT 30
        ) AS A
        
        UNION

        SELECT * FROM (
        SELECT `Id`, `Title`, `Submit`, `Abstract`, `Type`, `FileName`
        FROM `Posts`
        WHERE `Type`=\'Row\'
        ORDER BY `Id`
        DESC LIMIT 3
        ) AS B

        UNION

        SELECT * FROM (
        SELECT `Id`, `Title`, `Submit`, `Abstract`, `Type`, `FileName`
        FROM `Posts`
        WHERE `Type`=\'Slider\'
        ORDER BY `Id`
        DESC LIMIT 5
        ) AS C
        ';
        $Result = $this->DoSelect($Query);
        return $Result;
    }

    function GetAllPosts() {
        $Query = "SELECT `Id`, `Title`, `FileName`, YEAR(`Submit`) 'Year', MONTH(`Submit`) 'Month', DAY(`Submit`) 'Day', `Abstract`, `Body` FROM `Posts` ORDER BY `Id` DESC";
        $Result = $this->DoSelect($Query);
        return $Result;
    }

    function InsertPost($Values) {
        $Query = 'INSERT INTO `Posts` (`Title`, `Abstract`, `Body`, `Type`, `FileName`) VALUES (:Title, :Abstract, :Body, :Type, :FileName)';
        $Result = $this->DoQuery($Query, $Values);
        return $Result;
    }


    function UpdatePost($Values) {
        $Query = 'UPDATE `Posts` SET `Title` = :Title, `Abstract` = :Abstract, `Body` = :Body, `Type` = :Type, `FileName` = :FileName WHERE `Id`=:Id';
        $Result = $this->DoQuery($Query, $Values);
        return $Result;
    }

    function DeletePost($Values) {
        $Query = 'DELETE FROM `Posts` WHERE `Id`=:Id';
        $Result = $this->DoQuery($Query, $Values);
        return $Result;
    }


    function GetPostById($Values) {
        $Query = "SELECT `Id`, `Title`, `Type`, `FileName`, YEAR(`Submit`) 'Year', MONTH(`Submit`) 'Month', DAY(`Submit`) 'Day', `Abstract`, `Body` FROM `Posts` WHERE `Id`=:Id LIMIT 1";
        $Result = $this->DoSelect($Query, $Values);
        return $Result;
    }

}