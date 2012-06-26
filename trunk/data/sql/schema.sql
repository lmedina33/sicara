CREATE TABLE asignatura (codigo_asignatura VARCHAR(10), nombre VARCHAR(250) NOT NULL, intensidad_horaria INT UNSIGNED NOT NULL, is_practica TINYINT DEFAULT '0' NOT NULL, id_semestre INT UNSIGNED NOT NULL, INDEX id_semestre_idx (id_semestre), PRIMARY KEY(codigo_asignatura)) ENGINE = INNODB;
CREATE TABLE asignatura_cursada (id_asignatura_cursada INT UNSIGNED AUTO_INCREMENT, nota_asignatura_cursada FLOAT(18, 2), nota_habilitacion_asignatura_cursada FLOAT(18, 2), nota_nivelacion_asignatura_cursada FLOAT(18, 2), is_homologacion TINYINT DEFAULT '0' NOT NULL, asistencia INT UNSIGNED DEFAULT '0' NOT NULL, observaciones TEXT, codigo_estudiante VARCHAR(10) NOT NULL, codigo_asignatura VARCHAR(10) NOT NULL, id_periodo INT UNSIGNED NOT NULL, id_asignador INT UNSIGNED, INDEX codigo_asignatura_idx (codigo_asignatura), INDEX codigo_estudiante_idx (codigo_estudiante), INDEX id_periodo_idx (id_periodo), INDEX id_asignador_idx (id_asignador), PRIMARY KEY(id_asignatura_cursada)) ENGINE = INNODB;
CREATE TABLE certificacion_docente (id_certificacion_docente INT UNSIGNED AUTO_INCREMENT, titulo VARCHAR(45) NOT NULL, numero VARCHAR(45) NOT NULL, id_tipo_certificacion INT UNSIGNED, codigo_profesor VARCHAR(10) NOT NULL, INDEX codigo_profesor_idx (codigo_profesor), INDEX id_tipo_certificacion_idx (id_tipo_certificacion), PRIMARY KEY(id_certificacion_docente)) ENGINE = INNODB;
CREATE TABLE estado_estudiante (id_estado_estudiante INT AUTO_INCREMENT, nombre VARCHAR(50) NOT NULL, is_primario TINYINT NOT NULL, descripcion TEXT, PRIMARY KEY(id_estado_estudiante)) ENGINE = INNODB;
CREATE TABLE estudiante (codigo_estudiante VARCHAR(10), fecha_ingreso DATE NOT NULL, fecha_retiro DATE NOT NULL, id_estado INT, id_estado_secundario INT, id_usuario INT UNSIGNED NOT NULL, codigo_pensum VARCHAR(10) NOT NULL, INDEX id_estado_secundario_idx (id_estado_secundario), INDEX codigo_pensum_idx (codigo_pensum), INDEX id_estado_idx (id_estado), INDEX id_usuario_idx (id_usuario), PRIMARY KEY(codigo_estudiante)) ENGINE = INNODB;
CREATE TABLE foto_usuario (id_foto_usuario INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(30) NOT NULL, tipo VARCHAR(30) NOT NULL, fecha DATE NOT NULL, imagen LONGBLOB NOT NULL, id_usuario INT UNSIGNED NOT NULL, INDEX id_usuario_idx (id_usuario), PRIMARY KEY(id_foto_usuario)) ENGINE = INNODB;
CREATE TABLE grupo (id_grupo INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(250) NOT NULL, id_periodo INT UNSIGNED NOT NULL, certificacion_primaria INT UNSIGNED, certificacion_secundaria INT UNSIGNED, fecha_inicio DATE, fecha_fin DATE, observaciones TEXT, codigo_asignatura VARCHAR(10) NOT NULL, codigo_profesor VARCHAR(10), inicio_calificacion DATETIME, fin_calificacion DATETIME, INDEX codigo_asignatura_idx (codigo_asignatura), INDEX codigo_profesor_idx (codigo_profesor), INDEX certificacion_primaria_idx (certificacion_primaria), PRIMARY KEY(id_grupo)) ENGINE = INNODB;
CREATE TABLE grupo_has_estudiante (codigo_estudiante VARCHAR(10), id_grupo INT UNSIGNED, PRIMARY KEY(codigo_estudiante, id_grupo)) ENGINE = INNODB;
CREATE TABLE inscrito (numero_formulario VARCHAR(10), id_jornada INT UNSIGNED, id_tipo_pago INT UNSIGNED, id_periodo INT UNSIGNED NOT NULL, id_usuario INT UNSIGNED NOT NULL, is_matriculado TINYINT, fecha_inscripcion DATE, INDEX id_jornada_idx (id_jornada), INDEX id_periodo_idx (id_periodo), INDEX id_tipo_pago_idx (id_tipo_pago), INDEX id_usuario_idx (id_usuario), PRIMARY KEY(numero_formulario)) ENGINE = INNODB;
CREATE TABLE jornada (id_jornada INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(45) NOT NULL, PRIMARY KEY(id_jornada)) ENGINE = INNODB;
CREATE TABLE lib_categoria (codigo_lib_categoria VARCHAR(10), nombre VARCHAR(100) NOT NULL, descripcion TEXT, dias_prestamo INT DEFAULT '0' NOT NULL, cantidad_sancion FLOAT(18, 2) DEFAULT 0.00 NOT NULL, id_tipo_sancion INT UNSIGNED, INDEX id_tipo_sancion_idx (id_tipo_sancion), PRIMARY KEY(codigo_lib_categoria)) ENGINE = INNODB;
CREATE TABLE lib_estado (id_lib_estado INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(45) NOT NULL, descripcion TEXT, PRIMARY KEY(id_lib_estado)) ENGINE = INNODB;
CREATE TABLE lib_item (serial_lib_item VARCHAR(25), descripcion TEXT, ubicacion TEXT, fecha_actualizacion DATE, is_prestado TINYINT NOT NULL, id_lib_estado INT UNSIGNED NOT NULL, id_lib_material INT UNSIGNED NOT NULL, INDEX id_lib_estado_idx (id_lib_estado), INDEX id_lib_material_idx (id_lib_material), PRIMARY KEY(serial_lib_item)) ENGINE = INNODB;
CREATE TABLE lib_material (id_lib_material INT UNSIGNED AUTO_INCREMENT, codigo_lib_material VARCHAR(25), titulo TEXT NOT NULL, sub_titulo TEXT, autores TEXT NOT NULL, editorial TEXT NOT NULL, fecha_publicacion DATE NOT NULL, fecha_actualizacion DATE, descripcion TEXT, temas TEXT NOT NULL, is_referencia TINYINT DEFAULT '0' NOT NULL, is_solo_profesor TINYINT DEFAULT '0' NOT NULL, is_prestado TINYINT DEFAULT '0' NOT NULL, codigo_lib_categoria VARCHAR(20) NOT NULL, id_lib_tipo_material INT UNSIGNED NOT NULL, INDEX codigo_lib_categoria_idx (codigo_lib_categoria), INDEX id_lib_tipo_material_idx (id_lib_tipo_material), PRIMARY KEY(id_lib_material)) ENGINE = INNODB;
CREATE TABLE lib_prestamo (id_prestamo INT UNSIGNED AUTO_INCREMENT, id_prestamista INT UNSIGNED NOT NULL, id_solicitante INT UNSIGNED NOT NULL, fecha_solicitud DATETIME NOT NULL, fecha_entrega DATETIME, fecha_retorno DATETIME, fecha_devolucion DATETIME, observaciones TEXT, serial_lib_item VARCHAR(25) NOT NULL, INDEX serial_lib_item_idx (serial_lib_item), INDEX id_prestamista_idx (id_prestamista), INDEX id_solicitante_idx (id_solicitante), PRIMARY KEY(id_prestamo)) ENGINE = INNODB;
CREATE TABLE lib_sancion (id_lib_sancion INT AUTO_INCREMENT, cantidad FLOAT(18, 2) NOT NULL, serial_lib_item VARCHAR(25) NOT NULL, fecha_imposicion DATETIME NOT NULL, fecha_inicio DATETIME NOT NULL, fecha_fin DATETIME NOT NULL, observaciones TEXT, id_sancionado INT UNSIGNED NOT NULL, id_ejecutor INT UNSIGNED NOT NULL, id_tipo_sancion INT UNSIGNED NOT NULL, INDEX serial_lib_item_idx (serial_lib_item), INDEX id_ejecutor_idx (id_ejecutor), INDEX id_sancionado_idx (id_sancionado), INDEX id_tipo_sancion_idx (id_tipo_sancion), PRIMARY KEY(id_lib_sancion)) ENGINE = INNODB;
CREATE TABLE lib_tipo_material (id_lib_tipo_material INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(100) NOT NULL, descripcion TEXT, dias_prestamo INT NOT NULL, cantidad_sancion FLOAT(18, 2) NOT NULL, id_lib_tipo_sancion INT UNSIGNED, INDEX id_lib_tipo_sancion_idx (id_lib_tipo_sancion), PRIMARY KEY(id_lib_tipo_material)) ENGINE = INNODB;
CREATE TABLE lib_tipo_sancion (id_lib_tipo_sancion INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(50) NOT NULL, descripcion TEXT, PRIMARY KEY(id_lib_tipo_sancion)) ENGINE = INNODB;
CREATE TABLE matricula (id_matricula INT AUTO_INCREMENT, fecha DATE NOT NULL, id_periodo INT UNSIGNED NOT NULL, id_jornada INT UNSIGNED, id_tipo_pago INT UNSIGNED, codigo_estudiante VARCHAR(10) NOT NULL, INDEX codigo_estudiante_idx (codigo_estudiante), INDEX id_jornada_idx (id_jornada), INDEX id_periodo_idx (id_periodo), INDEX id_tipo_pago_idx (id_tipo_pago), PRIMARY KEY(id_matricula)) ENGINE = INNODB;
CREATE TABLE parcial (id_parcial INT UNSIGNED AUTO_INCREMENT, porcentaje FLOAT(18, 2) NOT NULL, calificacion FLOAT(18, 2), id_asignatura_cursada INT UNSIGNED NOT NULL, id_calificador INT UNSIGNED NOT NULL, INDEX id_calificador_idx (id_calificador), INDEX id_asignatura_cursada_idx (id_asignatura_cursada), PRIMARY KEY(id_parcial)) ENGINE = INNODB;
CREATE TABLE pensum (codigo_pensum VARCHAR(10), nombre VARCHAR(250) NOT NULL, PRIMARY KEY(codigo_pensum)) ENGINE = INNODB;
CREATE TABLE periodo_academico (id_periodo_academico INT UNSIGNED AUTO_INCREMENT, periodo VARCHAR(6) NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE, estado TINYINT DEFAULT '0' NOT NULL, codigo_pensum VARCHAR(10) NOT NULL, id_predecesor INT UNSIGNED, observacion TEXT, INDEX codigo_pensum_idx (codigo_pensum), PRIMARY KEY(id_periodo_academico)) ENGINE = INNODB;
CREATE TABLE profesor (codigo_profesor VARCHAR(10), fecha_ingreso DATE, fecha_retiro DATE, id_usuario INT UNSIGNED NOT NULL, INDEX id_usuario_idx (id_usuario), PRIMARY KEY(codigo_profesor)) ENGINE = INNODB;
CREATE TABLE ref_elemento (id_ref_elemento INT UNSIGNED AUTO_INCREMENT, serial VARCHAR(100), serial_interno VARCHAR(100), nombre VARCHAR(150) NOT NULL, marca VARCHAR(100), modelo VARCHAR(100), descripcion TEXT, cantidad_sancion FLOAT(18, 2), ubicacion TEXT, is_prestable TINYINT DEFAULT '0' NOT NULL, id_ref_tipo_elemento INT UNSIGNED NOT NULL, id_ref_lugar INT UNSIGNED, id_ref_estado_elemento INT UNSIGNED NOT NULL, id_ref_tipo_sancion INT UNSIGNED, id_usuario_responsable INT UNSIGNED, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX id_ref_tipo_elemento_idx (id_ref_tipo_elemento), INDEX id_ref_estado_elemento_idx (id_ref_estado_elemento), INDEX id_ref_lugar_idx (id_ref_lugar), INDEX id_ref_tipo_sancion_idx (id_ref_tipo_sancion), INDEX id_usuario_responsable_idx (id_usuario_responsable), PRIMARY KEY(id_ref_elemento)) ENGINE = INNODB;
CREATE TABLE ref_estado_elemento (id_ref_estado_elemento INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(50) NOT NULL, descripcion TEXT, PRIMARY KEY(id_ref_estado_elemento)) ENGINE = INNODB;
CREATE TABLE ref_foto_elemento (id_ref_foto_elemento INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(150), path VARCHAR(150), id_ref_elemento INT UNSIGNED, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX id_ref_elemento_idx (id_ref_elemento), PRIMARY KEY(id_ref_foto_elemento)) ENGINE = INNODB;
CREATE TABLE ref_hoja_vida (id_ref_hoja_vida INT UNSIGNED AUTO_INCREMENT, descripcion TEXT, id_ref_elemento INT UNSIGNED NOT NULL, id_usuario_creador INT UNSIGNED NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX id_ref_elemento_idx (id_ref_elemento), INDEX id_usuario_creador_idx (id_usuario_creador), PRIMARY KEY(id_ref_hoja_vida)) ENGINE = INNODB;
CREATE TABLE ref_lugar (id_ref_lugar INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(100) NOT NULL, descripcion TEXT, capacidad_personas INT UNSIGNED, ubicacion TEXT, id_ref_lugar_contenedor INT UNSIGNED, id_ref_tipo_lugar INT UNSIGNED, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX id_ref_tipo_lugar_idx (id_ref_tipo_lugar), INDEX id_ref_lugar_contenedor_idx (id_ref_lugar_contenedor), PRIMARY KEY(id_ref_lugar)) ENGINE = INNODB;
CREATE TABLE ref_prestamo (id_ref_prestamo INT UNSIGNED AUTO_INCREMENT, id_prestamista INT UNSIGNED NOT NULL, id_solicitante INT UNSIGNED NOT NULL, fecha_solicitud DATETIME NOT NULL, fecha_entrega DATETIME, fecha_retorno DATETIME, fecha_devolucion DATETIME, observaciones TEXT, id_ref_elemento INT UNSIGNED, INDEX id_ref_elemento_idx (id_ref_elemento), INDEX id_prestamista_idx (id_prestamista), INDEX id_solicitante_idx (id_solicitante), PRIMARY KEY(id_ref_prestamo)) ENGINE = INNODB;
CREATE TABLE ref_sancion (id_ref_sancion INT UNSIGNED AUTO_INCREMENT, cantidad FLOAT(18, 2) NOT NULL, id_ref_elemento INT UNSIGNED, fecha_imposicion DATETIME NOT NULL, fecha_inicio DATETIME NOT NULL, fecha_fin DATETIME NOT NULL, observaciones TEXT, id_sancionado INT UNSIGNED NOT NULL, id_ejecutor INT UNSIGNED NOT NULL, id_ref_tipo_sancion INT UNSIGNED NOT NULL, INDEX id_ref_tipo_sancion_idx (id_ref_tipo_sancion), INDEX id_ejecutor_idx (id_ejecutor), INDEX id_sancionado_idx (id_sancionado), INDEX id_ref_elemento_idx (id_ref_elemento), PRIMARY KEY(id_ref_sancion)) ENGINE = INNODB;
CREATE TABLE ref_tipo_elemento (id_ref_tipo_elemento INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(50) NOT NULL, descripcion TEXT, PRIMARY KEY(id_ref_tipo_elemento)) ENGINE = INNODB;
CREATE TABLE ref_tipo_lugar (id_ref_tipo_lugar INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(50) NOT NULL, descripcion TEXT, PRIMARY KEY(id_ref_tipo_lugar)) ENGINE = INNODB;
CREATE TABLE ref_tipo_sancion (id_ref_tipo_sancion INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(50) NOT NULL, descripcion TEXT, PRIMARY KEY(id_ref_tipo_sancion)) ENGINE = INNODB;
CREATE TABLE semestre (id_semestre INT UNSIGNED AUTO_INCREMENT, numero INT UNSIGNED NOT NULL, intensidad_horaria INT UNSIGNED NOT NULL, codigo_pensum VARCHAR(10) NOT NULL, INDEX codigo_pensum_idx (codigo_pensum), PRIMARY KEY(id_semestre)) ENGINE = INNODB;
CREATE TABLE tipo_certificacion (id_tipo_certificacion INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(45) NOT NULL, descripcion VARCHAR(100), PRIMARY KEY(id_tipo_certificacion)) ENGINE = INNODB;
CREATE TABLE tipo_documento (id_tipo_documento INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(45) NOT NULL, PRIMARY KEY(id_tipo_documento)) ENGINE = INNODB;
CREATE TABLE tipo_pago (id_tipo_pago INT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(45) NOT NULL, PRIMARY KEY(id_tipo_pago)) ENGINE = INNODB;
CREATE TABLE usuario (id_usuario INT UNSIGNED AUTO_INCREMENT, primer_nombre VARCHAR(45) NOT NULL, segundo_nombre VARCHAR(45), primer_apellido VARCHAR(45) NOT NULL, segundo_apellido VARCHAR(45), documento VARCHAR(20) NOT NULL, id_tipo_documento INT UNSIGNED NOT NULL, lugar_expedicion VARCHAR(200), telefono1 VARCHAR(25), telefono2 VARCHAR(25), direccion TEXT, correo VARCHAR(50), acudiente1 VARCHAR(100), telefono_acudiente1 VARCHAR(25), acudiente2 VARCHAR(100), telefono_acudiente2 VARCHAR(25), especificaciones_medicas TEXT, observaciones TEXT, id_sf_guard_user INT UNSIGNED NOT NULL, INDEX id_tipo_documento_idx (id_tipo_documento), PRIMARY KEY(id_usuario)) ENGINE = INNODB;
CREATE TABLE usuario_has_ref_elemento (id_usuario INT UNSIGNED, id_ref_elemento INT UNSIGNED, PRIMARY KEY(id_usuario, id_ref_elemento)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE asignatura ADD CONSTRAINT asignatura_id_semestre_semestre_id_semestre FOREIGN KEY (id_semestre) REFERENCES semestre(id_semestre);
ALTER TABLE asignatura_cursada ADD CONSTRAINT asignatura_cursada_id_asignador_usuario_id_usuario FOREIGN KEY (id_asignador) REFERENCES usuario(id_usuario);
ALTER TABLE asignatura_cursada ADD CONSTRAINT aipi FOREIGN KEY (id_periodo) REFERENCES periodo_academico(id_periodo_academico);
ALTER TABLE asignatura_cursada ADD CONSTRAINT acec FOREIGN KEY (codigo_estudiante) REFERENCES estudiante(codigo_estudiante);
ALTER TABLE asignatura_cursada ADD CONSTRAINT acac_1 FOREIGN KEY (codigo_asignatura) REFERENCES asignatura(codigo_asignatura);
ALTER TABLE certificacion_docente ADD CONSTRAINT citi FOREIGN KEY (id_tipo_certificacion) REFERENCES tipo_certificacion(id_tipo_certificacion);
ALTER TABLE certificacion_docente ADD CONSTRAINT certificacion_docente_codigo_profesor_profesor_codigo_profesor FOREIGN KEY (codigo_profesor) REFERENCES profesor(codigo_profesor);
ALTER TABLE estudiante ADD CONSTRAINT estudiante_id_usuario_usuario_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE estudiante ADD CONSTRAINT estudiante_id_estado_estado_estudiante_id_estado_estudiante FOREIGN KEY (id_estado) REFERENCES estado_estudiante(id_estado_estudiante);
ALTER TABLE estudiante ADD CONSTRAINT estudiante_codigo_pensum_pensum_codigo_pensum FOREIGN KEY (codigo_pensum) REFERENCES pensum(codigo_pensum);
ALTER TABLE estudiante ADD CONSTRAINT eiei_1 FOREIGN KEY (id_estado_secundario) REFERENCES estado_estudiante(id_estado_estudiante);
ALTER TABLE foto_usuario ADD CONSTRAINT foto_usuario_id_usuario_usuario_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE grupo ADD CONSTRAINT grupo_codigo_profesor_profesor_codigo_profesor FOREIGN KEY (codigo_profesor) REFERENCES profesor(codigo_profesor);
ALTER TABLE grupo ADD CONSTRAINT grupo_codigo_asignatura_asignatura_codigo_asignatura FOREIGN KEY (codigo_asignatura) REFERENCES asignatura(codigo_asignatura);
ALTER TABLE grupo ADD CONSTRAINT gcci FOREIGN KEY (certificacion_primaria) REFERENCES certificacion_docente(id_certificacion_docente);
ALTER TABLE grupo_has_estudiante ADD CONSTRAINT grupo_has_estudiante_id_grupo_grupo_id_grupo FOREIGN KEY (id_grupo) REFERENCES grupo(id_grupo);
ALTER TABLE grupo_has_estudiante ADD CONSTRAINT gcec FOREIGN KEY (codigo_estudiante) REFERENCES estudiante(codigo_estudiante);
ALTER TABLE inscrito ADD CONSTRAINT inscrito_id_usuario_usuario_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE inscrito ADD CONSTRAINT inscrito_id_tipo_pago_tipo_pago_id_tipo_pago FOREIGN KEY (id_tipo_pago) REFERENCES tipo_pago(id_tipo_pago);
ALTER TABLE inscrito ADD CONSTRAINT inscrito_id_periodo_periodo_academico_id_periodo_academico FOREIGN KEY (id_periodo) REFERENCES periodo_academico(id_periodo_academico);
ALTER TABLE inscrito ADD CONSTRAINT inscrito_id_jornada_jornada_id_jornada FOREIGN KEY (id_jornada) REFERENCES jornada(id_jornada);
ALTER TABLE lib_categoria ADD CONSTRAINT lili FOREIGN KEY (id_tipo_sancion) REFERENCES lib_tipo_sancion(id_lib_tipo_sancion);
ALTER TABLE lib_item ADD CONSTRAINT lib_item_id_lib_material_lib_material_id_lib_material FOREIGN KEY (id_lib_material) REFERENCES lib_material(id_lib_material);
ALTER TABLE lib_item ADD CONSTRAINT lib_item_id_lib_estado_lib_estado_id_lib_estado FOREIGN KEY (id_lib_estado) REFERENCES lib_estado(id_lib_estado);
ALTER TABLE lib_material ADD CONSTRAINT lili_1 FOREIGN KEY (id_lib_tipo_material) REFERENCES lib_tipo_material(id_lib_tipo_material);
ALTER TABLE lib_material ADD CONSTRAINT lclc_1 FOREIGN KEY (codigo_lib_categoria) REFERENCES lib_categoria(codigo_lib_categoria);
ALTER TABLE lib_prestamo ADD CONSTRAINT lib_prestamo_serial_lib_item_lib_item_serial_lib_item FOREIGN KEY (serial_lib_item) REFERENCES lib_item(serial_lib_item);
ALTER TABLE lib_prestamo ADD CONSTRAINT lib_prestamo_id_solicitante_usuario_id_usuario FOREIGN KEY (id_solicitante) REFERENCES usuario(id_usuario);
ALTER TABLE lib_prestamo ADD CONSTRAINT lib_prestamo_id_prestamista_usuario_id_usuario FOREIGN KEY (id_prestamista) REFERENCES usuario(id_usuario);
ALTER TABLE lib_sancion ADD CONSTRAINT lib_sancion_serial_lib_item_lib_item_serial_lib_item FOREIGN KEY (serial_lib_item) REFERENCES lib_item(serial_lib_item);
ALTER TABLE lib_sancion ADD CONSTRAINT lib_sancion_id_tipo_sancion_lib_tipo_sancion_id_lib_tipo_sancion FOREIGN KEY (id_tipo_sancion) REFERENCES lib_tipo_sancion(id_lib_tipo_sancion);
ALTER TABLE lib_sancion ADD CONSTRAINT lib_sancion_id_sancionado_usuario_id_usuario FOREIGN KEY (id_sancionado) REFERENCES usuario(id_usuario);
ALTER TABLE lib_sancion ADD CONSTRAINT lib_sancion_id_ejecutor_usuario_id_usuario FOREIGN KEY (id_ejecutor) REFERENCES usuario(id_usuario);
ALTER TABLE lib_tipo_material ADD CONSTRAINT lili_2 FOREIGN KEY (id_lib_tipo_sancion) REFERENCES lib_tipo_sancion(id_lib_tipo_sancion);
ALTER TABLE matricula ADD CONSTRAINT matricula_id_tipo_pago_tipo_pago_id_tipo_pago FOREIGN KEY (id_tipo_pago) REFERENCES tipo_pago(id_tipo_pago);
ALTER TABLE matricula ADD CONSTRAINT matricula_id_periodo_periodo_academico_id_periodo_academico FOREIGN KEY (id_periodo) REFERENCES periodo_academico(id_periodo_academico);
ALTER TABLE matricula ADD CONSTRAINT matricula_id_jornada_jornada_id_jornada FOREIGN KEY (id_jornada) REFERENCES jornada(id_jornada);
ALTER TABLE matricula ADD CONSTRAINT matricula_codigo_estudiante_estudiante_codigo_estudiante FOREIGN KEY (codigo_estudiante) REFERENCES estudiante(codigo_estudiante);
ALTER TABLE parcial ADD CONSTRAINT piai FOREIGN KEY (id_asignatura_cursada) REFERENCES asignatura_cursada(id_asignatura_cursada);
ALTER TABLE parcial ADD CONSTRAINT parcial_id_calificador_usuario_id_usuario FOREIGN KEY (id_calificador) REFERENCES usuario(id_usuario);
ALTER TABLE periodo_academico ADD CONSTRAINT periodo_academico_codigo_pensum_pensum_codigo_pensum FOREIGN KEY (codigo_pensum) REFERENCES pensum(codigo_pensum);
ALTER TABLE profesor ADD CONSTRAINT profesor_id_usuario_usuario_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE ref_elemento ADD CONSTRAINT riri_2 FOREIGN KEY (id_ref_tipo_sancion) REFERENCES ref_tipo_sancion(id_ref_tipo_sancion);
ALTER TABLE ref_elemento ADD CONSTRAINT riri_1 FOREIGN KEY (id_ref_estado_elemento) REFERENCES ref_estado_elemento(id_ref_estado_elemento);
ALTER TABLE ref_elemento ADD CONSTRAINT riri FOREIGN KEY (id_ref_tipo_elemento) REFERENCES ref_tipo_elemento(id_ref_tipo_elemento);
ALTER TABLE ref_elemento ADD CONSTRAINT ref_elemento_id_usuario_responsable_usuario_id_usuario FOREIGN KEY (id_usuario_responsable) REFERENCES usuario(id_usuario);
ALTER TABLE ref_elemento ADD CONSTRAINT ref_elemento_id_ref_lugar_ref_lugar_id_ref_lugar FOREIGN KEY (id_ref_lugar) REFERENCES ref_lugar(id_ref_lugar);
ALTER TABLE ref_foto_elemento ADD CONSTRAINT ref_foto_elemento_id_ref_elemento_ref_elemento_id_ref_elemento FOREIGN KEY (id_ref_elemento) REFERENCES ref_elemento(id_ref_elemento);
ALTER TABLE ref_hoja_vida ADD CONSTRAINT ref_hoja_vida_id_usuario_creador_usuario_id_usuario FOREIGN KEY (id_usuario_creador) REFERENCES usuario(id_usuario);
ALTER TABLE ref_hoja_vida ADD CONSTRAINT ref_hoja_vida_id_ref_elemento_ref_elemento_id_ref_elemento FOREIGN KEY (id_ref_elemento) REFERENCES ref_elemento(id_ref_elemento);
ALTER TABLE ref_lugar ADD CONSTRAINT ref_lugar_id_ref_tipo_lugar_ref_tipo_lugar_id_ref_tipo_lugar FOREIGN KEY (id_ref_tipo_lugar) REFERENCES ref_tipo_lugar(id_ref_tipo_lugar);
ALTER TABLE ref_lugar ADD CONSTRAINT ref_lugar_id_ref_lugar_contenedor_ref_lugar_id_ref_lugar FOREIGN KEY (id_ref_lugar_contenedor) REFERENCES ref_lugar(id_ref_lugar);
ALTER TABLE ref_prestamo ADD CONSTRAINT ref_prestamo_id_solicitante_usuario_id_usuario FOREIGN KEY (id_solicitante) REFERENCES usuario(id_usuario);
ALTER TABLE ref_prestamo ADD CONSTRAINT ref_prestamo_id_ref_elemento_ref_elemento_id_ref_elemento FOREIGN KEY (id_ref_elemento) REFERENCES ref_elemento(id_ref_elemento);
ALTER TABLE ref_prestamo ADD CONSTRAINT ref_prestamo_id_prestamista_usuario_id_usuario FOREIGN KEY (id_prestamista) REFERENCES usuario(id_usuario);
ALTER TABLE ref_sancion ADD CONSTRAINT riri_4 FOREIGN KEY (id_ref_tipo_sancion) REFERENCES ref_tipo_sancion(id_ref_tipo_sancion);
ALTER TABLE ref_sancion ADD CONSTRAINT ref_sancion_id_sancionado_usuario_id_usuario FOREIGN KEY (id_sancionado) REFERENCES usuario(id_usuario);
ALTER TABLE ref_sancion ADD CONSTRAINT ref_sancion_id_ref_elemento_ref_elemento_id_ref_elemento FOREIGN KEY (id_ref_elemento) REFERENCES ref_elemento(id_ref_elemento);
ALTER TABLE ref_sancion ADD CONSTRAINT ref_sancion_id_ejecutor_usuario_id_usuario FOREIGN KEY (id_ejecutor) REFERENCES usuario(id_usuario);
ALTER TABLE semestre ADD CONSTRAINT semestre_codigo_pensum_pensum_codigo_pensum FOREIGN KEY (codigo_pensum) REFERENCES pensum(codigo_pensum);
ALTER TABLE usuario ADD CONSTRAINT usuario_id_tipo_documento_tipo_documento_id_tipo_documento FOREIGN KEY (id_tipo_documento) REFERENCES tipo_documento(id_tipo_documento);
ALTER TABLE usuario_has_ref_elemento ADD CONSTRAINT usuario_has_ref_elemento_id_usuario_usuario_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE usuario_has_ref_elemento ADD CONSTRAINT uiri FOREIGN KEY (id_ref_elemento) REFERENCES ref_elemento(id_ref_elemento);
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
