<?php

/**
 * refLugar actions.
 *
 * @package    sicara2
 * @subpackage refLugar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class refLugarActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->ref_lugars = Doctrine_Core::getTable('RefLugar')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new RefLugarForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new RefLugarForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($ref_lugar = Doctrine_Core::getTable('RefLugar')->find(array($request->getParameter('id_ref_lugar'))), sprintf('Object ref_lugar does not exist (%s).', $request->getParameter('id_ref_lugar')));
        $this->form = new RefLugarForm($ref_lugar);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($ref_lugar = Doctrine_Core::getTable('RefLugar')->find(array($request->getParameter('id_ref_lugar'))), sprintf('Object ref_lugar does not exist (%s).', $request->getParameter('id_ref_lugar')));
        $this->form = new RefLugarForm($ref_lugar);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($ref_lugar = Doctrine_Core::getTable('RefLugar')->find(array($request->getParameter('id_ref_lugar'))), sprintf('Object ref_lugar does not exist (%s).', $request->getParameter('id_ref_lugar')));
        $ref_lugar->delete();

        $this->redirect('refLugar/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $ref_lugar = $form->save();

            $this->redirect('refLugar/edit?id_ref_lugar=' . $ref_lugar->getIdRefLugar());
        }
    }

    public function executeGetArbol(sfWebRequest $request) {

        sfProjectConfiguration::getActive()->loadHelpers('Url');
        
        $sedes = Doctrine_Core::getTable('RefLugar')->findBy('id_ref_tipo_lugar', 1);

        $arbol = "";
        foreach ($sedes as $sede) {
            $arbol = $arbol . '<li><img src="/images/iconos/sede.png" /> '. $sede->getNombre() .' <a class="administracion" href="' . url_for('refLugar/edit?id_ref_lugar='.$sede->getIdRefLugar()) . ')"><img src="/images/iconos/editSmall.png"></a>';

            $edificios = Doctrine_Core::getTable('RefLugar')
                    ->createQuery('l')
                    ->where('id_ref_tipo_lugar = 2')
                    ->andWhere('id_ref_lugar_contenedor = ?', $sede->getIdRefLugar())
                    ->execute();

            if ($edificios->count() > 0) {
                $arbol = $arbol . '<ul>';

                foreach ($edificios as $edificio) {
                    $arbol = $arbol . '<li><img src="/images/iconos/edificio.png" /> ' . $edificio->getNombre() . ' <a class="administracion" href="' . url_for('refLugar/edit?id_ref_lugar='.$edificio->getIdRefLugar()) . ')"><img src="/images/iconos/editSmall.png"></a>';

                    $lugares = Doctrine_Core::getTable('RefLugar')->findBy('id_ref_lugar_contenedor', $edificio->getIdRefLugar());

                    if ($lugares->count() > 0) {
                        $arbol = $arbol . '<ul>';
                        foreach ($lugares AS $lugar) {
                            $arbol = $arbol . '<li>';

                            switch ($lugar->getIdRefTipoLugar()) {
                                case '3': $arbol = $arbol . '<img src="/images/iconos/oficina.png" />';
                                    break;
                                case '4': $arbol = $arbol . '<img src="/images/iconos/auditorio.png" />';
                                    break;
                                case '5': $arbol = $arbol . '<img src="/images/iconos/salon.png" />';
                                    break;
                                case '6': $arbol = $arbol . '<img src="/images/iconos/laboratorio.png" />';
                                    break;
                                default: $arbol = $arbol . '<img src="/images/iconos/lugar.png" />';
                            }

                            $arbol = $arbol . '' . $lugar->getNombre() . ' <a class="administracion" href="' . url_for('refLugar/edit?id_ref_lugar='.$lugar->getIdRefLugar()) . ')"><img src="/images/iconos/editSmall.png"></a></li>';
                        }
                        $arbol = $arbol . '</ul>';
                    }

                    $arbol = $arbol . '</li>';
                }

                $arbol = $arbol . '</ul>';
            }
            $arbol = $arbol . '</li>';
        }

        return $this->renderText($arbol);
    }

}
