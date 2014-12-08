<core-icon-button icon="add-circle-outline" id="postsButtonAdd"></core-icon-button>

<?php
foreach ($posts as $post)
{
?>
<div class="postEntry">
    <core-item class="heading" label="<?php echo h($post['Post']['heading']); ?>" horizontal center layout></core-item>
    <core-item class="body" label="<?php echo h($post['Post']['body']); ?>" horizontal center layout></core-item>
    <core-item class="user" label="<?php echo h($post['Account']['username']);?>" horizontal center layout></core-item>
    <core-item class="created" label="<?php echo h($post['Post']['created']); ?>" horizontal center layout></core-item>
    <core-tooltip label="Eintrag löschen" pressed id="core_tooltip">
      <core-icon-button icon="delete" id="core_icon_button1" class="delete"></core-icon-button>
    </core-tooltip>
    <core-tooltip label="Eintrag bearbeiten" active pressed id="core_tooltip1">
      <core-icon-button icon="text-format" id="core_icon_button" class="edit"></core-icon-button>
    </core-tooltip>
</div>
<?php
}
?>