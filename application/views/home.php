<script>document.title = 'Home - Job Portal';</script>
<style>
	.main_div{height: 100%;width: 70%;padding: 0;position: relative;top: 100px;margin-left: auto;margin-right: auto;}
	
</style>

<section class="home">
	<div class="main_div">
		<h1 class='text-center font-weight-bold' id="system-tagline">Finding The Right One Isn’t Hard</h1>
		
		<div class="clear-fix" style="margin-top:5em"></div>
		<div class="row" style="display:flex;justify-content:center">
			<div class="input-group input-group-lg col-lg-8 col-md-10 col-sm-12 col-xs-12">
				<input type="search" class="form-control" name="search" id="search" value="<?= isset($search) ? $search : '' ?>" placeholder="Search Company, Jobs, or any">
				<div class="input-group-addon">
					<a href="javascript:void(0)" class="text-decoration-none text-secondary" id="search-btn"><i class="fa fa-search"></i></a>
				</div>
			</div>
		</div>
		<div class="clear-fix" style="margin-top:5em"></div>
		<div class="text-center">
			<a href="<?=base_url()?>jobs"><button class="btn btn-lg btn-primary">FIND SUITABLE JOB</button></a>
			<a href="<?=base_url()?>post_job"><button class="btn btn-lg btn-primary">POST NEW JOBS</button></a>
		</div>	
	</div>	
</section>

<script>
	function search_job($keyword = ''){
		location.href = "<?= base_url() ?>jobs?search="+$keyword
	}
	$(function(){
		$('#search').keypress(function(e){
			if(e.which === 13){
				e.preventDefault()
				search_job($(this).val())
			}
		})
		$('#search-btn').click(function(){
			search_job($('#search').val())
		})
	})
</script>