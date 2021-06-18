<?php use Uniform\Form;

return function ($kirby, $page) {
  $form = new Form(kirbyForms()->formRules($page));
  kirbyForms()->processRequest($page, $form);
  return compact('form');
};