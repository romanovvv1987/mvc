<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Project name</a>
		</div>

	</div>
</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">

</div>

<div class="container">
	<button type="button" class="btn btn-danger" id="load">Загрузить</button><br><br>
	<!-- Example row of columns -->
	<div class="row" id="news">
		<?php foreach ($this->data as $item): ?>
			<div class="panel panel-default" id="<?php echo $item['id'] ?>">
				<div class="panel-heading">#<?php echo $item['id'] ?></div>
				<div class="panel-body">
					<?php echo $item['text'] ?>
				</div>
			</div>
		<?php endforeach; ?>


	</div>

	<hr>

	<footer>
		<p>&copy; Company 2014</p>
	</footer>
</div> <!-- /container -->

<script>
	$(document).ready(function () {

		/**
		 * Load  new messages
		 */
		function onloadAjax() {
			var inProgress = false;
			var end = $('#news').children('div').eq(0).attr('id');

			$.ajax({
				url: '/index/getdata',
				method: 'post',
				data: {"start": ++end},

				beforeSend: function () {
					inProgress = true;
				}

			}).done(function (data) {

				data = data != "" ? $.parseJSON(data) : {};

				if (data.length > 0) {
					$.each(data, function (index, data) {
						++end
						$("#news").prepend(
							'<div class="panel panel-danger" id="' + data.id + '">'
								+ '<div class="panel-heading">#' + data.id + '</div>'
								+ '<div class="panel-body">'
								+ data.text +'</div></div>'

						);
					});

					inProgress = false;

				}
			});


		}


		$('#load').click(function () {
			onloadAjax();
		});

		setInterval(function() {
			onloadAjax()
		}, 60000);



	});
</script>