<core-tooltip label="Eintrag hinzufügen" active pressed id="core_tooltip2">
    <core-icon-button icon="add-circle-outline" id="postsButtonAdd"></core-icon-button>
</core-tooltip>
<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
document.addEventListener('polymer-ready', function(){
    document.querySelector('#postsButtonAdd').addEventListener('click', function(e) {
        $.get('<?php echo $this->webroot."posts/add";?>', function( data ) {
            $('#postEntries').before(data);
        });
    });
});
<?php echo $this->Html->scriptEnd();?>

<div id="postEntries">
    <?php
    foreach ($posts as $post)
    {
    ?>
    <div id="postEntry<?php echo h($post['Post']['id']); ?>" class="postEntry">
        <core-item class="heading" label="<?php echo h($post['Post']['heading']); ?>" horizontal center layout></core-item>
        <core-item class="body" label="<?php echo h($post['Post']['body']); ?>" horizontal center layout></core-item>
        <core-item class="user" label="<?php echo h($post['Account']['username']);?>" horizontal center layout></core-item>
        <core-item class="created" label="<?php echo h($post['Post']['created']); ?>" horizontal center layout></core-item>
        <core-tooltip label="Eintrag löschen" pressed id="core_tooltip">
          <core-icon-button icon="delete" id="postEntryButtonDelete<?php echo h($post['Post']['id']); ?>" class="delete"></core-icon-button>
        </core-tooltip>
        <core-tooltip label="Eintrag bearbeiten" active pressed id="core_tooltip1">
          <core-icon-button icon="text-format" id="postEntryButtonEdit<?php echo h($post['Post']['id']); ?>" class="edit"></core-icon-button>
        </core-tooltip>
    </div>
    <?php
    }
    ?>
</div>