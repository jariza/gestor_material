<?php echo "<h1>Cambiar contraseña</h1>\n"; ?>
<div class="users form">
<?php echo $this->Form->create('Usuario'); ?>
    <fieldset>
        <legend><?php echo __('Cambiar contraseña'); ?></legend>
        <?php echo $this->Form->input('curpassword', array('type' => 'password', 'label' => 'Contraseña actual'));
        echo $this->Form->input('password1', array('type' => 'password', 'label' => 'Nueva contraseña'));
        echo $this->Form->input('password2', array('type' => 'password', 'label' => 'Repita la nueva contraseña'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Cambiar contraseña')); ?>
</div>
