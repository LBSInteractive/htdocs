<?php

/***************************************************************************************
*          Controlador arduino_Connection
***************************************************************************************/

  /**
   * require_once Importar Model y Vista
   * @var Link
   */
  require_once('./arduino_ConnectionModel.php');
  require_once('../../view/view_class.php');

  /* Arranque */
  handler();




  /**
   * handler Middleware o Handler intermediario entre vista y controlador directo
   * @return none
   */
  function handler()
  {
      /**
       * $obj_view y $obj_model Instancias de Objetos View y Model
       * @var Class
       */
      $obj_view = create_obj_view();
      $obj_model = create_obj_model();

      /**
       * Renderizar Vista (dir,nombreArchivoHTML)
       */
      print($obj_view->get_template('arduino_Connection_ng', 'arduino_Connection'));
  }


  /**
   * create_obj_model Instanciar clase modelo new 'MODELO'
   * @return Class
   */
  function create_obj_model()
  {
      $obj = new Model();
      return $obj;
  }


  /**
   * create_obj_view Instanciar clase vista new 'VISTA'
   * @return Class
   */
  function create_obj_view()
  {
      $obj = new view();
      return $obj;
  }
