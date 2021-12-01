<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript">

	$(document).ready(function(){
			//$('#funcionario_cpf').mask('000.000.000-00',{placeholder:'999.999.999-99'});
			$('#telefone').mask('(99) 99999-9999',{placeholder:'(XX) XXXXX-XXXX'}); 

		});
	function EnviarDadosPorEmail(){
		let nome = $('#nome').val();
		let email = $('#email').val();
		let telefone = $('#telefone').val().replace('(', '').replace(')', '').replace(' ', '').replace('-', '');
		let mensagem = $('#mensagem').val();
		console.log(telefone);
		if(nome=="" || nome.length < 5){
			alert( "Preencha o Nome corretamente!" );
		}else if (email=="" || email.indexOf('@')== -1 || email.indexOf('.')==-1){
			alert( "Prencha o E-mail corretamente!" );
		}else if(telefone == '' || telefone.length < 11){
			alert( "Prencha o telefone corretamente!" );
		} else if (mensagem=="" || mensagem.length < 5){
			alert( "Escreva uma mensagem!" );
		}else {
			$('#enviado').html('');
			$('#enviado').append('<div class="alert alert-success alert-dismissible fade show" role="alert" id="enviado"><strong>Mensagem Enviada!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
			setTimeout(function () {  
				$('#enviado').html('');
			}, 8 * 1000);
			$.ajax({
				url: "<?php echo base_url()?>welcome/EnviarDadosPorEmail",
				dataType: 'json',
				type: 'post',
				data: {nome:nome,email:email,telefone:telefone,mensagem:mensagem},
				cache:false,
				success: function(data){
				},
				error: function(d){

					return false;
				}
			});
		}
		
	}
</script>

<nav class="navbar navbar-expand-lg site-navbar navbar-light bg-light" id="pb-navbar">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample09">
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="#inicio">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
				<li class="nav-item"><a class="nav-link" href="#resumo">Resumo</a></li>
				<li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
				<li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
			</ul>
		</div>
	</div>
</nav>
<section class="site-hero" style="background-image: url(images/My.jpeg); background-size:1600px 800px;" id="inicio" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row intro-text align-items-center justify-content-center">
			<div class="col-md-10 text-center pt-5">
				<h1 class="site-heading site-animate">Olá, eu sou <strong class="d-block">Robson Danilo</strong></h1>
				<strong class="d-block text-white text-uppercase letter-spacing">e esse é o meu resumo</strong>
			</div>
		</div>
	</div>
</section> 




<section class="site-section" id="section-portfolio">
	<div class="container">
		<div class="row">
			<div class="section-heading text-center col-md-12">
				<h2>Portfolio <strong>em destaques</strong></h2>
			</div>
		</div>
		<div class="filters">
			<ul>
				<li class="active" data-filter="*">Todos</li>
				<li data-filter=".web">Web</li>
				<li data-filter=".mobile">Mobile</li>
			</ul>
		</div>
		<div class="filters-content">
			<div class="row grid">
				<div class="single-portfolio col-sm-4 all mobile">
					<div class="relative">
						<a href="https://github.com/robson-danilo/projetoSolidario" target="_blank" class="img-pop-up">
							<div class="thumb">
								<div class="overlay overlay-bg"></div>
								<img class="image img-fluid" src="images/centro.jpeg" alt="">
							</div>
						</a>
					</div>
					<div class="p-inner">
						<h4>Projeto Web Solidario</h4>
						<div class="cat">Web</div>
					</div>
				</div>
				<div class="single-portfolio col-sm-4 all web">
					<div class="relative">
						<a href="https://github.com/robson-danilo/projetomobile" target="_blank" class="img-pop-up">
							<div class="thumb">
								<div class="overlay overlay-bg"></div>
								<img class="image img-fluid" src="images/ipeticon1.png" alt="">
							</div>
						</a>
					</div>
					<div class="p-inner">
						<h4>Projeto Mobile Ipet</h4>
						<div class="cat">Mobile</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>






<section class="site-section " id="resumo">
	<div class="container">
		<div class="row">
			<div class="col-md-12 mb-5">
				<div class="section-heading text-center">
					<h2>Meu <strong>Resumo</strong></h2>
				</div>
			</div>
			<div class="col-md-6">
				<h2 class="mb-5">Educação</h2>
				<div class="resume-item mb-4">
					<span class="date"><span class="icon-calendar"></span> Janeiro 2018 - Atualmente</span>
					<h3>Ciência da Computação - Bacharelado</h3>
					<p>Universidade muito boa, onde pude ter uma gama bastante ampla de conhecimento e desafios.</p>
					<span class="school">Centro Universitário dos Guararapes</span>
				</div>
			</div>
			<div class="col-md-6">
				<h2 class="mb-5">Experiência</h2>
				<div class="resume-item mb-4">
					<span class="date"><span class="icon-calendar"></span> Novembro 2019 - Atualmente</span>
					<h3>Desenvolvedor Web</h3>
					<p>Desenvolver tanto na parte Back End quanto no Front End.</p>
					<span class="school">ANS Sistemas</span>
				</div>
				<div class="resume-item mb-4">
					<span class="date"><span class="icon-calendar"></span> Agosto 2018 - Outubro 2019</span>
					<h3>Suporte TI</h3>
					<p>Auxiliar no suporte de TI.</p>
					<span class="school">Prefeitura de Ipojuca</span>
				</div>
			</div>
		</div>
	</div>
</section> 
<section class="site-section" id="sobre">
	<div class="container">
		<div class="row mb-5 align-items-center">
			<div class="col-lg-7 pr-lg-5 mb-5 mb-lg-0">
				<img src="images/My.png" alt="Image placeholder" class="img-fluid">
			</div>
			<div class="col-lg-5 pl-lg-5">
				<div class="section-heading">
					<h2>Sobre <strong>mim</strong></h2>
				</div>
				<p class="lead">Sou uma pessoa esforçada, trabalho muito bem em equipe e tenho experiência em liderar.</p>
				<p class="mb-5  ">Costumo a fazer oque posso para poder ajudar os outros a resolverem determinados problemas, explicando de maneira mais simples possível, nunca desisto de algo quando eu começo.</p>
				<p>
					<a href="#contato" class="btn btn-primary px-4 py-2 btn-sm smoothscroll">Entrar em Contato</a>
				</p>
			</div>
		</div>
	</div>
</section>
<!--
<section class="site-section">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md-12">
				<div class="section-heading text-center">
					<h2>Client <strong>Testimonial</strong></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="block-47 d-flex mb-5">
					<div class="block-47-image">
						<img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid">
					</div>
					<blockquote class="block-47-quote">
						<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
						<cite class="block-47-quote-author">&mdash; Ethan McCown, CEO <a href="#">XYZ Inc.</a></cite>
					</blockquote>
				</div>
			</div>
			<div class="col-md-6">
				<div class="block-47 d-flex mb-5">
					<div class="block-47-image">
						<img src="images/person_2.jpg" alt="Image placeholder" class="img-fluid">
					</div>
					<blockquote class="block-47-quote">
						<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
						<cite class="block-47-quote-author">&mdash; Craig Gowen, CEO <a href="#">XYZ Inc.</a></cite>
					</blockquote>
				</div>
			</div>
			<div class="col-md-6">
				<div class="block-47 d-flex mb-5">
					<div class="block-47-image">
						<img src="images/person_3.jpg" alt="Image placeholder" class="img-fluid">
					</div>
					<blockquote class="block-47-quote">
						<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
						<cite class="block-47-quote-author">&mdash; Ethan McCown, CEO <a href="#">XYZ Inc.</a></cite>
					</blockquote>
				</div>
			</div>
			<div class="col-md-6">
				<div class="block-47 d-flex mb-5">
					<div class="block-47-image">
						<img src="images/person_4.jpg" alt="Image placeholder" class="img-fluid">
					</div>
					<blockquote class="block-47-quote">
						<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
						<cite class="block-47-quote-author">&mdash; Craig Gowen, CEO <a href="#">XYZ Inc.</a></cite>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</section>
-->
<section class="site-section pb-0" id="section-services">
	<div class="container">
		<div class="row mb-4">
			<div class="col-md-12">
				<div class="section-heading text-center">
					<h2>Meus <strong>Serviços</strong></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-lg-4 text-center mb-5">
				<div class="site-service-item site-animate" data-animate-effect="fadeIn">
					<span class="icon">
						<span class="fas fa-globe"></span>
					</span>
					<h3 class="mb-4">Desenvolvedor Web</h3>
					<p>Tenho uma boa experiência como desenvolvedor Web, utilizando as tecnologias, PHP, JAVASCRIPT, HTML5, CSS3 e framework Codelgniter.</p>
					<p><a href="#portfolio" class="site-link">Saber mais <i class="fab fa-dev"></i></a></p>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 text-center mb-5">
				<div class="site-service-item site-animate" data-animate-effect="fadeIn">
					<span class="icon">
						<span class="fa fa-mobile"></span>
					</span>
					<h3 class="mb-4">Desenvolvedor Mobile Android/IOS</h3>
					<p>Tenho uma experiência curta em desenvolvimento mobile, sendo essa tudo que eu aprendi foi autodidata, utilizando as tecnologias, Angular, TypeScript e o framework IONIC5 com integração com uma API tendo essa como Back End base PHP</p>
					<p><a href="#portfolio" class="site-link">Saber mais <i class="fab fa-dev"></i></a></p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--
<section class="site-section" id="section-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-12 mb-5">
				<div class="section-heading text-center">
					<h2>Blog on <strong>Medium</strong></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-4 mb-4">
				<div class="blog-entry">
					<a href="#"><img src="images/post_1.jpg" alt="Image placeholder" class="img-fluid"></a>
					<div class="blog-entry-text">
						<h3><a href="#">Creative Product Designer From Facebook</a></h3>
						<p class="mb-4">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<div class="meta">
							<a href="#"><span class="icon-calendar"></span> Aug 7, 2018</a>
							<a href="#"><span class="icon-bubble"></span> 5 Comments</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 mb-4">
				<div class="blog-entry">
					<a href="#"><img src="images/post_2.jpg" alt="Image placeholder" class="img-fluid"></a>
					<div class="blog-entry-text">
						<h3><a href="#">Creative Product Designer From Facebook</a></h3>
						<p class="mb-4">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<div class="meta">
							<a href="#"><span class="icon-calendar"></span> Aug 7, 2018</a>
							<a href="#"><span class="icon-bubble"></span> 5 Comments</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 mb-4">
				<div class="blog-entry">
					<a href="#"><img src="images/post_3.jpg" alt="Image placeholder" class="img-fluid"></a>
					<div class="blog-entry-text">
						<h3><a href="#">Creative Product Designer From Facebook</a></h3>
						<p class="mb-4">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<div class="meta">
							<a href="#"><span class="icon-calendar"></span> Aug 7, 2018</a>
							<a href="#"><span class="icon-bubble"></span> 5 Comments</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
-->
<section class="site-section" id="contato">
	<div class="container">
		<div class="row">
			<div class="col-md-12 mb-5">
				<div class="section-heading text-center">
					<h2>Entrar <strong>em Contato</strong></h2>
				</div>
			</div>
			<div class="col-md-7 mb-5 mb-md-0">
				
				<h3 class="mb-5">Entrar em contato</h3>

				<div class="form-group">
					<input type="text" required="required" name="nome" id="nome" class="form-control px-3 py-4" placeholder="Nome">
				</div>
				<div class="form-group">
					<input type="email" required="required" name="email" id="email" class="form-control px-3 py-4" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="text" required="required" name="telefone" id="telefone" class="form-control px-3 py-4" placeholder="Telefone">
				</div>
				<div class="form-group mb-5">
					<textarea class="form-control px-3 py-4" required="required" name="mensagem" id="mensagem" cols="30" rows="10" placeholder="Mensagem"></textarea>
				</div>
				<div id="enviado"></div>
				<div class="form-group">
					<input type="submit" onclick="EnviarDadosPorEmail()" class="btn btn-primary  px-4 py-3" value="Enviar Mensagem">
				</div>
			</div>
			<div class="col-md-5 pl-md-5">
				<h3 class="mb-5">Detalhes de Contato</h3>
				<ul class="site-contact-details">
					<li>
						<span class="text-uppercase">Email</span>
						robson.coelho2021@gmail.com
					</li>
					<li>
						<span class="text-uppercase">Telefone/Whatsapp</span>
						+81 98661-7327
					</li>
					<li>
						<span class="text-uppercase">Endereço</span>
						Ipojuca, PE <br>
						Centro <br>
						Cep 55590-000
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<footer class="site-footer">
	<div class="container">
		<div class="row mb-5">
		</div>
		<div class="row mb-5">
			<div class="col-md-12 text-center">
				<p>
					<a href="https://www.facebook.com/robson.danilo.39/" target="_blank" class="social-item"><span class="fab fa-facebook-f"></span></a>
					<a href="https://www.instagram.com/robson_danilo_/?hl=pt-br" target="_blank" class="social-item"><span class="fab fa-instagram"></span></a>
					<a href="https://www.linkedin.com/in/robson-danilo-2714b9160/" target="_blank" class="social-item"><span class="fab fa-linkedin-in"></span></a>
					<a href="https://api.whatsapp.com/send?phone=5581986617327" target="_blank" class="social-item"><span class="fa fa-whatsapp"></span></a>
				</p>
			</div>
		</div>
	</div>
</footer>


<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-23581568-13');
</script>
