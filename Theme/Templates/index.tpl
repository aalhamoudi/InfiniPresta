{extends file='page.tpl'}
    {block name='page_content_container'}
      <section id="content" class="page-home">
        {block name='page_content_top'}{/block}

        {block name='page_content'}
          {block name='hook_home'}
            {hook h="slider"}
            <div id="slider"></div>
            <div id="banners"></div>
            <div id="featuredProducts"></div>
            {$HOOK_HOME nofilter}
          {/block}
        {/block}
      </section>
    {/block}
