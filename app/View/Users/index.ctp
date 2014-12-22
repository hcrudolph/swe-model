<paper-tabs noink selected="0" selectedindex="0" class="tabsBar" id="userTabs" layout center horizontal>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Allgemein</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Tarife</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Zertifikate</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Trainingspläne</paper-tab>
</paper-tabs>


<core-pages selected="0" selectedindex="0" notap class="tabsPages" id="userTabsPages">
    <div id="userTabPageAllgemein"></div>
    <div id="userTabPageTarife"></div>
    <div id="userTabPageZertifikate"></div>
    <div id="userTabPageTrainingspläne"></div>
</core-pages>

<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
$('#userTabPageAllgemein').load('<?php echo $this->webroot."Users/listing/"?>');

    var paperTabs = document.querySelector('#userTabs');
    var corePages = document.querySelector('#userTabsPages');

    paperTabs.addEventListener('core-select', function(e) {
    if (e.detail.isSelected) {
    switch(paperTabs.selected)
    {
        case 0: $('#userTabPageAllgemein').load('<?php echo $this->webroot."Account/index/"?>'); break;
        case 1: $('#userTabPageTarife').load('<?php echo $this->webroot."Tariffs/index/"?>'); break;
        case 2: $('#userTabPageZertifikate').load('<?php echo $this->webroot."Certificates/listing/"?>'); break;
        case 3: $('#userTabPageTrainingspläne').load('<?php echo $this->webroot."AccountsTrainings/index/"?>'); break;
    }
corePages.selected = paperTabs.selected;
}
});


<?php
echo $this->Html->scriptEnd();
?>