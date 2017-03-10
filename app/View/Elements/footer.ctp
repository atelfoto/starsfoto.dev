	<ul class='list-inline'>
		<li><?php  echo $this->Html->link(__('Legal Information'), array(
			'controller' => 'pages', 'action' => 'legalinformation')); ?> |
		</li>
		<li><?php  echo $this->Html->link( __('Contact Us'), array(
			'controller' => 'contacts', 'action' => 'index')); ?> |
		</li>
		<li><?php  echo $this->Html->link(__("sitemap"), array('controller' => 'pages', 'action' => 'sitemap')); ?>
		</li>
	</ul>
	<address id="hcard-starsfoto" itemscope itemtype="http://schema.org/Person" class="vcard">
		<small class="fn n">
			<span itemprop="name" class="given-name street-address"> <?php echo strtoupper("stars foto"); ?></span><br />
			<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="streetAddress">Ricardo Soriano 28,</span><br />
				<span class="postal-code" itemprop="postalCode">29601</span>
				<span itemprop="addressLocality" class="locality country-name"> <?php echo ucwords("marbella"); ?></span>
			</span>
			<br>
			<i class='icon-phone'>&nbsp;</i>
			<abbr title="Phone"> Tel : <a href="tel:+34952828218" class="tel" rel="nofollow" itemprop="telephone">952 828 218</a>
			</abbr>
		</small> <br />
		<p>
			<i class="copyright">Copyright &copy; 2005-<?php echo date('Y'); ?>  by
				<span class="url" itemprop="url">
					<?php echo $this->Html->link( env('HTTP_HOST'), array('controller' => 'pages', 'action' => 'index','full_base'=>true)); ?>
				</span> &nbsp; all rights reserved.
			</i>
		</p>
	</address>

