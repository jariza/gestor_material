<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>
		<?php echo "Gestión de material - ".Configure::read('datosevento.nombre')." - $title_for_layout"; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php
				if (Configure::check('datosevento.imagencabecera')) {
					echo "<img style=\"max-width:100%; height: auto\" src=\"".Configure::read('datosevento.imagencabecera')."\" alt=\"Cabecera\" />\n";
				}
			?>
		</div>
		<?php if ($logueado) { ?>
			<div id="nav" class="navright">
				<ul>
					<li><?php echo $this->Html->link('Ir al inicio', '/'); ?></li>
					<li><?php echo "Conectado como $facadeuname"; ?></li>
					<li><?php echo $this->Html->link('Cambiar password', array('controller' => 'Usuarios', 'action' => 'chpass')); ?></li>
					<li><?php echo $this->Html->link('Logout', array('controller' => 'Usuarios', 'action' => 'logout')); ?></li>
				</ul>
			</div>
		<?php } else { ?>
			<div id="nav" class="navleft">
				<p>Gestión de material</p>
			</div>
		<?php } ?>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php
				if (Configure::check('datosevento.imagenpie')) {
					echo "<img style=\"max-width:100%; height: auto\" src=\"".Configure::read('datosevento.imagenpie')."\" alt=\"Pie\" />\n";
				}
			?>
			<div id="subfooter">
				<p id="copyright">Gestor de material</p>
				<p id="poweredby">
					<?php echo $this->Html->link(
							$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
							'http://www.cakephp.org/',
							array('target' => '_blank', 'escape' => false)
						);
					?>
				</p>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
