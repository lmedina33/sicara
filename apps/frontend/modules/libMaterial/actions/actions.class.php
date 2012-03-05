<?php

/**
 * libMaterial actions.
 *
 * @package    sicara2
 * @subpackage libMaterial
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class libMaterialActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->lib_materials = Doctrine_Core::getTable('LibMaterial')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LibMaterialForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LibMaterialForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('codigo_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('codigo_lib_material')));
    $this->form = new LibMaterialForm($lib_material);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('codigo_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('codigo_lib_material')));
    $this->form = new LibMaterialForm($lib_material);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('codigo_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('codigo_lib_material')));
    $lib_material->delete();

    $this->redirect('libMaterial/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $lib_material = $form->save();

      $this->redirect('libMaterial/edit?codigo_lib_material='.$lib_material->getCodigoLibMaterial());
    }
  }
  
    public function executeValidarCodigo(sfWebRequest $request){
      $value=$request->getParameter('fieldValue');
      $id=$request->getParameter('fieldId');
      $material = Doctrine_Core::getTable('LibMaterial')->find($value);
      $data=array();
      $data[0]=$id;
      if($material==null){
          $data[1]=true;
      }else{
          $data[1]=false;
      }
      
      return $this->renderText(json_encode($data));
      
  }
  
    
  public function executeVer(sfWebRequest $request){
      $this->material = Doctrine_Core::getTable('LibMaterial')->find($request->getParameter('id'));
      
      $this->items=$this->material->getLibItem();
      
      
      $this->autores=$this->autores."<ul class=verMasAutores>";
      $aux= explode("\n", $this->material->getAutores());
      foreach($aux as $autor){
          $this->autores=$this->autores."<li>".$autor."</li>";
      }
      $this->autores=$this->autores."</ul>";
      
      
      $this->descripciones=$this->descripciones."<ul class=verMasDescripciones>";
      $aux= explode("\n", $this->material->getDescripcion());
      foreach($aux as $descripcion){
          $this->descripciones=$this->descripciones."<li>".$descripcion."</li>";
      }
      $this->descripciones=$this->descripciones."</ul>";
      
      
      $this->temas=$this->temas."<ul class=verMasTemas>";
      $aux= explode("\n", $this->material->getTemas());
      foreach($aux as $tema){
          $this->temas=$this->temas."<li>".$tema."</li>";
      }
      $this->temas=$this->temas."</ul>";
  }
  
  public function executeDeleteItem(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

//    $this->forward404Unless($lib_material = Doctrine_Core::getTable('LibMaterial')->find(array($request->getParameter('codigo_lib_material'))), sprintf('Object lib_material does not exist (%s).', $request->getParameter('codigo_lib_material')));
//    $lib_material->delete();

    $this->redirect('libMaterial/index');
  }
}
