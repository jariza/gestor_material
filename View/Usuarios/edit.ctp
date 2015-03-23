<?php echo "<h1>Editar usuario</h1>\n"; ?>
<div class="usuarios form">
<?php echo $this->Form->create('Usuario'); ?>
    <fieldset>
        <legend><?php echo __('Editar usuario'); ?></legend>
        <?php echo $this->Form->input('name');
        echo $this->Form->input('username');
		echo $this->Form->input('email');
        echo $this->Form->input('rol', array('options' => Configure::read('roles')));
        echo $this->Form->input('zonas', array('options' => $zonas, 'multiple' => true));
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->submit('Guardar usuario', array('after' => $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btncancelar'))));
    ?>
    </fieldset>
    
<?php echo $this->Form->end(); ?>

</div>

<?php
echo $this->Html->script('jquery');
echo $this->Html->scriptBlock('
	$("#UsuarioRol").change(function() {
		if ($("#UsuarioRol").val() == \'managerzona\') {
			$("#UsuarioZonas").removeAttr(\'disabled\');
		}
		else {
			$("#UsuarioZonas").prop(\'disabled\', true);
		}
	});
	$("#UsuarioRol").trigger(\'change\');
');
?>
