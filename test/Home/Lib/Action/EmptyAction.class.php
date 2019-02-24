<?php
class EmptyAction extends Action
{
public function index()
{
echo "<script language=javascript>history.go(-1);</script>";
exit;
}
public function _empty()
{
echo "<script language=javascript>history.go(-1);</script>";
exit;
}
}