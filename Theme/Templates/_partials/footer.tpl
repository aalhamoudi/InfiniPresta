<div class="hbox centered">
  <div id="newsletter">
    {block name='hook_subscription'}
      {hook h='displaySubscription'}
    {/block}
  </div>
</div>
<div class="footer-container vbox">
    <div class="hbox centered">
      <div id="information">
        {block name='hook_information'}
          {hook h='displayInformation'}
        {/block}
      </div>
      <div id="links">
        {block name='hook_links'}
          {hook h='displayLinks'}
        {/block}
      </div>
      <div id="location">
        {block name='hook_location'}
          {hook h='displayLocation'}
        {/block}
      </div>
    </div>
    <div class="hbox border-top">
      <div id="copyright">
          {block name='hook_copyright'}
            {hook h='displayCopyright'}
          {/block}
      </div>
    </div>
</div>
