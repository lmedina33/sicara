<?php

/**
 * calificaciones actions.
 *
 * @package    sicara2
 * @subpackage calificaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calificacionesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $usuario = Doctrine_Core::getTable('Usuario')->findBy('id_sf_guard_user',sfContext::getInstance()->getUser()->getGuardUser()->getId())->getFirst();
      $estudiantes = Doctrine_Core::getTable('Estudiante')->findBy('id_usuario',$usuario->getIdUsuario());
      
      $this->data=array();
      
      foreach($estudiantes as $estudiante){
          $pensum = $estudiante->getPensum();
          
          $dPensum = array();
          $dPensum['pensum']=$pensum;
          
          $semestres = Doctrine_Core::getTable('Semestre')
                  ->createQuery()
                  ->where('codigo_pensum = ?',$pensum->getCodigoPensum())
                  ->orderBy('numero ASC')
                  ->execute();
          
          $dSemestres = array();
          
          foreach($semestres as $semestre){
              $dSemestre = array();
              
              $dSemestre['semestre']=$semestre;
              
              $asignaturas=  Doctrine_Core::getTable('Asignatura')->findBy('id_semestre', $semestre->getIdSemestre());
              
              $dAsignaturas = array();
              foreach($asignaturas as $asignatura){
                  $dAsignatura = array();
                  $dAsignatura['asignatura']=$asignatura;
                  
                  $dNotas = array();
                  
                  $notas = Doctrine_Core::getTable('AsignaturaCursada')
                      ->createQuery('ac')
                      ->where('ac.codigo_estudiante = ?',$estudiante->getCodigoEstudiante())
                      ->andWhere('ac.codigo_asignatura = ?',$asignatura->getCodigoAsignatura())
                      ->orderBy('ac.id_periodo DESC')
                      ->execute();
                  
                  foreach($notas as $nota){
                      $dNotasH =array();
                      
                      $dNotasH['asignatura']=$nota->getAsignatura();;
                      $dNotasH['nota']=  intval($nota->getNotaAsignaturaCursada());
                      $dNotasH['asistencia']=$nota->getAsistencia();
                      $dNotasH['nivelacion']=$nota->getNotaNivelacionAsignaturaCursada();
                      $dNotasH['homologacion']=$nota->getIsHomologacion();
                      $dNotasH['periodo']=$nota->getPeriodoAcademico()->getPeriodo();
                      $dNotasH['aprobada']=$nota->getIsAprobada();
                      $dNotasH['parcial1']='';
                      $dNotasH['parcial2']='';
                      $dNotasH['parcial2']='';
                      
                      $parciales = Doctrine_Core::getTable('Parcial')
                              ->createQuery()
                              ->where('id_asignatura_cursada = ?',$nota->getIdAsignaturaCursada())
                              ->orderBy('orden ASC')
                              ->execute();
                      
                      foreach($parciales as $parcial){
                          if($parcial->getOrden()==1)
                             $dNotasH['parcial1']=intval($parcial->getCalificacion()); 
                          
                          if($parcial->getOrden()==2)
                             $dNotasH['parcial2']=intval($parcial->getCalificacion()); 
                          
                          if($parcial->getOrden()==3)
                             $dNotasH['parcial3']=intval($parcial->getCalificacion()); 
                      }
                      
                      $dNotas[]=$dNotasH;
                  }
                  
                  $dAsignatura['notas']=$dNotas;
                  ///Fin cuadrar las notas
                  
                  $dAsignaturas[]=$dAsignatura;
              }
              
              $dSemestre['asignaturas']=$dAsignaturas;
              
              $dSemestres[]=$dSemestre;
              
          }
          $dPensum['semestres']=$dSemestres;
          
          
          $this->data[]=$dPensum;
      }
    
  }
}
