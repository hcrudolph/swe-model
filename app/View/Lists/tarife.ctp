<div class="row">
    <div class="col-xs-6">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Beiträge</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Grundbetrag</td>
                    <td>29,99€</td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th>Getränke</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="popoverElement"><span class="popoverContainer"></span><span class="popoverContent" style="display:none;">Vanille, Erdbeere, Schokolade</span>Eiweißshakes (500ml)</td>
                <td>3,69€</td>
            </tr>
            <tr>
                <td class="popoverElement"><span class="popoverContainer"></span><span class="popoverContent" style="display:none;">Vanille, Erdbeere, Schokolade</span>Eiweißriegel (50g)</td>
                <td>2,00€</td>
            </tr>
            </tbody>
        </table>
        <?php echo $this->Html->scriptStart(array('inline' => true)); ?>
            $('.popoverElement').each(function() {
                $(this).popover({
                    html: true,
                    container: $(this).children('.popoverContainer'),
                    trigger: 'hover',
                    placement: 'top',
                    content: function() {
                        return $(this).children('.popoverContent').text();
                    }
                });
            });
        <?php echo $this->Html->scriptEnd(); ?>
    </div>
</div>