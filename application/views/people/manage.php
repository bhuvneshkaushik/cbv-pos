<?php $this->load->view("partial/header"); ?>

<script type="text/javascript">
$(document).ready(function()
{
	<?php $this->load->view('partial/bootstrap_tables_locale'); ?>

	table_support.init({
		resource: '<?php echo site_url($controller_name);?>',
		headers: <?php echo $table_headers; ?>,
		pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
		uniqueId: 'people.person_id',
		enableActions: function()
		{
			var email_disabled = $("td input:checkbox:checked").parents("tr").find("td a[href^='mailto:']").length == 0;
			$("#email").prop('disabled', email_disabled);
		}
	});

	$("#email").click(function(event)
	{
		var recipients = $.map($("tr.selected a[href^='mailto:']"), function(element)
		{
			return $(element).attr('href').replace(/^mailto:/, '');
		});
		location.href = "mailto:" + recipients.join(",");
	});
});

function openConcCheck() {

	var concID = document.getElementById('conc-id').value; // get the textbox value

	if (concID == 'Concession ID:') {
		throw ''; // exit if you just click the generate button without entering anything
	};
		window.open('./customer-lookup.php?conc-id=' + concID + '&range=alltime') // open the sales ticket
	}
</script>

<div id="title_bar" class="btn-toolbar">
	<?php
	if ($controller_name == 'customers')
	{
	?>
		<button class='btn btn-info btn-sm pull-right modal-dlg' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url($controller_name."/excel_import"); ?>'
				title='<?php echo $this->lang->line('customers_import_items_excel'); ?>'>
			<span class="glyphicon glyphicon-import">&nbsp</span><?php echo $this->lang->line('common_import_excel'); ?>
		</button>
	<?php
	}
	?>
	<button class='btn btn-info btn-sm pull-right modal-dlg' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url($controller_name."/view"); ?>'
			title='<?php echo $this->lang->line($controller_name . '_new'); ?>'>
		<span class="glyphicon glyphicon-user">&nbsp</span><?php echo $this->lang->line($controller_name . '_new'); ?>
	</button>

<!-- Look up Customer ID -->

    <button class='btn btn-info btn-sm pull-right' onclick="openConcCheck()">
        <span class="glyphicon glyphicon-file">&nbsp</span>Lookup ID
    </button>

	<input type="text" id="conc-id" onfocus="this.value=''" value="Concession ID:" class="form-control input-sm" id="" style="width: 125px;float: right;margin-right: 5px;">

</div>

<div id="toolbar">
	<div class="pull-left btn-toolbar">
		<button id="delete" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-trash">&nbsp</span><?php echo $this->lang->line("common_delete");?>
		</button>
		<button id="email" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-envelope">&nbsp</span><?php echo $this->lang->line("common_email");?>
		</button>
	</div>
</div>

<div id="table_holder">
	<table id="table"></table>
</div>

<?php $this->load->view("partial/footer"); ?>
