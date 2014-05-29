  


<!DOCTYPE html>
<html>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# githubog: http://ogp.me/ns/fb/githubog#">
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>jScrollPane/script/jquery.jscrollpane.js at master · vitch/jScrollPane · GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144.png" />
    <link rel="logo" type="image/svg" href="http://github-media-downloads.s3.amazonaws.com/github-logo.svg" />
    <meta name="msapplication-TileImage" content="/windows-tile.png">
    <meta name="msapplication-TileColor" content="#ffffff">

    
    
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

    <meta content="authenticity_token" name="csrf-param" />
<meta content="Qu8uZIE1ppBTzkXJukk+WOUXkhwvzIJ/dK0nMHldc+M=" name="csrf-token" />

    <link href="https://a248.e.akamai.net/assets.github.com/assets/github-bced846093783dc329a6bb21c8031d870340444b.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://a248.e.akamai.net/assets.github.com/assets/github2-36182176b3cf8d21e8b8575917ced76dba218ae6.css" media="all" rel="stylesheet" type="text/css" />
    


      <script src="https://a248.e.akamai.net/assets.github.com/assets/frameworks-d76b58e749b52bc47a4c46620bf2c320fabe5248.js" type="text/javascript"></script>
      <script src="https://a248.e.akamai.net/assets.github.com/assets/github-40c7aa81c92db6b30fd49b244db188a488e57983.js" type="text/javascript"></script>
      
      <meta http-equiv="x-pjax-version" content="d98d141e48d02ec8f52fb5c06c2490b6">

        <link data-pjax-transient rel='permalink' href='/vitch/jScrollPane/blob/548347a0c38bbb649048f42bfede478f7bc64e00/script/jquery.jscrollpane.js'>
    <meta property="og:title" content="jScrollPane"/>
    <meta property="og:type" content="githubog:gitrepository"/>
    <meta property="og:url" content="https://github.com/vitch/jScrollPane"/>
    <meta property="og:image" content="https://secure.gravatar.com/avatar/a585fc1dada8a7e34f1fea1e133e66d5?s=420&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png"/>
    <meta property="og:site_name" content="GitHub"/>
    <meta property="og:description" content="jScrollPane - Pretty, customisable, cross browser replacement scrollbars"/>
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="@GitHub">
    <meta property="twitter:title" content="vitch/jScrollPane"/>

    <meta name="description" content="jScrollPane - Pretty, customisable, cross browser replacement scrollbars" />

  <link href="https://github.com/vitch/jScrollPane/commits/master.atom" rel="alternate" title="Recent Commits to jScrollPane:master" type="application/atom+xml" />

  </head>


  <body class="logged_out page-blob windows vis-public env-production  ">
    <div id="wrapper">

      

      

      

      


        <div class="header header-logged-out">
          <div class="container clearfix">

            <a class="header-logo-wordmark" href="https://github.com/">
              <img alt="GitHub" class="github-logo-4x" height="30" src="https://a248.e.akamai.net/assets.github.com/images/modules/header/logov7@4x.png?1360648847" />
              <img alt="GitHub" class="github-logo-4x-hover" height="30" src="https://a248.e.akamai.net/assets.github.com/images/modules/header/logov7@4x-hover.png?1360648847" />
            </a>

              
<ul class="top-nav">
    <li class="explore"><a href="https://github.com/explore">Explore GitHub</a></li>
  <li class="search"><a href="https://github.com/search">Search</a></li>
  <li class="features"><a href="https://github.com/features">Features</a></li>
    <li class="blog"><a href="https://github.com/blog">Blog</a></li>
</ul>


            <div class="header-actions">
                <a class="button primary" href="https://github.com/signup">Sign up for free</a>
              <a class="button" href="https://github.com/login?return_to=%2Fvitch%2FjScrollPane%2Fblob%2Fmaster%2Fscript%2Fjquery.jscrollpane.js">Sign in</a>
            </div>

          </div>
        </div>


      

      


            <div class="site hfeed" itemscope itemtype="http://schema.org/WebPage">
      <div class="hentry">
        
        <div class="pagehead repohead instapaper_ignore readability-menu ">
          <div class="container">
            <div class="title-actions-bar">
              


<ul class="pagehead-actions">



    <li>
      <a href="/login?return_to=%2Fvitch%2FjScrollPane"
        class="minibutton js-toggler-target star-button entice tooltipped upwards"
        title="You must be signed in to use this feature" rel="nofollow">
        <span class="mini-icon mini-icon-star"></span>Star
      </a>
      <a class="social-count js-social-count" href="/vitch/jScrollPane/stargazers">
        1,163
      </a>
    </li>
    <li>
      <a href="/login?return_to=%2Fvitch%2FjScrollPane"
        class="minibutton js-toggler-target fork-button entice tooltipped upwards"
        title="You must be signed in to fork a repository" rel="nofollow">
        <span class="mini-icon mini-icon-fork"></span>Fork
      </a>
      <a href="/vitch/jScrollPane/network" class="social-count">
        296
      </a>
    </li>
</ul>

              <h1 itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="entry-title public">
                <span class="repo-label"><span>public</span></span>
                <span class="mega-icon mega-icon-public-repo"></span>
                <span class="author vcard">
                  <a href="/vitch" class="url fn" itemprop="url" rel="author">
                  <span itemprop="title">vitch</span>
                  </a></span> /
                <strong><a href="/vitch/jScrollPane" class="js-current-repository">jScrollPane</a></strong>
              </h1>
            </div>

            
  <ul class="tabs">
    <li><a href="/vitch/jScrollPane" class="selected" highlight="repo_source repo_downloads repo_commits repo_tags repo_branches">Code</a></li>
    <li><a href="/vitch/jScrollPane/network" highlight="repo_network">Network</a></li>
    <li><a href="/vitch/jScrollPane/pulls" highlight="repo_pulls">Pull Requests <span class='counter'>27</span></a></li>

      <li><a href="/vitch/jScrollPane/issues" highlight="repo_issues">Issues <span class='counter'>116</span></a></li>



    <li><a href="/vitch/jScrollPane/graphs" highlight="repo_graphs repo_contributors">Graphs</a></li>


  </ul>
  
<div class="tabnav">

  <span class="tabnav-right">
    <ul class="tabnav-tabs">
          <li><a href="/vitch/jScrollPane/tags" class="tabnav-tab" highlight="repo_tags">Tags <span class="counter ">13</span></a></li>
    </ul>
    
  </span>

  <div class="tabnav-widget scope">


    <div class="select-menu js-menu-container js-select-menu js-branch-menu">
      <a class="minibutton select-menu-button js-menu-target" data-hotkey="w" data-ref="master">
        <span class="mini-icon mini-icon-branch"></span>
        <i>branch:</i>
        <span class="js-select-button">master</span>
      </a>

      <div class="select-menu-modal-holder js-menu-content js-navigation-container">

        <div class="select-menu-modal">
          <div class="select-menu-header">
            <span class="select-menu-title">Switch branches/tags</span>
            <span class="mini-icon mini-icon-remove-close js-menu-close"></span>
          </div> <!-- /.select-menu-header -->

          <div class="select-menu-filters">
            <div class="select-menu-text-filter">
              <input type="text" id="commitish-filter-field" class="js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
            </div>
            <div class="select-menu-tabs">
              <ul>
                <li class="select-menu-tab">
                  <a href="#" data-tab-filter="branches" class="js-select-menu-tab">Branches</a>
                </li>
                <li class="select-menu-tab">
                  <a href="#" data-tab-filter="tags" class="js-select-menu-tab">Tags</a>
                </li>
              </ul>
            </div><!-- /.select-menu-tabs -->
          </div><!-- /.select-menu-filters -->

          <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket css-truncate" data-tab-filter="branches">

            <div data-filterable-for="commitish-filter-field" data-filterable-type="substring">

                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/1.x/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.x" rel="nofollow" title="1.x">1.x</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0_dev/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0_dev" rel="nofollow" title="2.0_dev">2.0_dev</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/aivopaas/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="aivopaas" rel="nofollow" title="aivopaas">aivopaas</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/external_container/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="external_container" rel="nofollow" title="external_container">external_container</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/feat_cot_both/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="feat_cot_both" rel="nofollow" title="feat_cot_both">feat_cot_both</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/feat_dynamic_resizing1/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="feat_dynamic_resizing1" rel="nofollow" title="feat_dynamic_resizing1">feat_dynamic_resizing1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/feat_dynamic_resizing2/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="feat_dynamic_resizing2" rel="nofollow" title="feat_dynamic_resizing2">feat_dynamic_resizing2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/feat_keypress/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="feat_keypress" rel="nofollow" title="feat_keypress">feat_keypress</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/feat_paneWidth/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="feat_paneWidth" rel="nofollow" title="feat_paneWidth">feat_paneWidth</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/issue_2/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="issue_2" rel="nofollow" title="issue_2">issue_2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target selected">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/master/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="master" rel="nofollow" title="master">master</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/mwheelintent/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="mwheelintent" rel="nofollow" title="mwheelintent">mwheelintent</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/skinnable/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="skinnable" rel="nofollow" title="skinnable">skinnable</a>
                </div> <!-- /.select-menu-item -->
            </div>

              <div class="select-menu-no-results">Nothing to show</div>
          </div> <!-- /.select-menu-list -->


          <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket css-truncate" data-tab-filter="tags">
            <div data-filterable-for="commitish-filter-field" data-filterable-type="substring">

                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta11/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta11" rel="nofollow" title="2.0.0beta11">2.0.0beta11</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta10/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta10" rel="nofollow" title="2.0.0beta10">2.0.0beta10</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta9/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta9" rel="nofollow" title="2.0.0beta9">2.0.0beta9</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta8/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta8" rel="nofollow" title="2.0.0beta8">2.0.0beta8</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta5/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta5" rel="nofollow" title="2.0.0beta5">2.0.0beta5</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta4/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta4" rel="nofollow" title="2.0.0beta4">2.0.0beta4</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta3/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta3" rel="nofollow" title="2.0.0beta3">2.0.0beta3</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta2/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta2" rel="nofollow" title="2.0.0beta2">2.0.0beta2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/2.0.0beta1/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="2.0.0beta1" rel="nofollow" title="2.0.0beta1">2.0.0beta1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/1.2.3/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.2.3" rel="nofollow" title="1.2.3">1.2.3</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/1.2.2/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.2.2" rel="nofollow" title="1.2.2">1.2.2</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/1.2.1/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.2.1" rel="nofollow" title="1.2.1">1.2.1</a>
                </div> <!-- /.select-menu-item -->
                <div class="select-menu-item js-navigation-item js-navigation-target ">
                  <span class="select-menu-item-icon mini-icon mini-icon-confirm"></span>
                  <a href="/vitch/jScrollPane/blob/1.2/script/jquery.jscrollpane.js" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.2" rel="nofollow" title="1.2">1.2</a>
                </div> <!-- /.select-menu-item -->
            </div>

            <div class="select-menu-no-results">Nothing to show</div>

          </div> <!-- /.select-menu-list -->

        </div> <!-- /.select-menu-modal -->
      </div> <!-- /.select-menu-modal-holder -->
    </div> <!-- /.select-menu -->

  </div> <!-- /.scope -->

  <ul class="tabnav-tabs">
    <li><a href="/vitch/jScrollPane" class="selected tabnav-tab" highlight="repo_source">Files</a></li>
    <li><a href="/vitch/jScrollPane/commits/master" class="tabnav-tab" highlight="repo_commits">Commits</a></li>
    <li><a href="/vitch/jScrollPane/branches" class="tabnav-tab" highlight="repo_branches" rel="nofollow">Branches <span class="counter ">13</span></a></li>
  </ul>

</div>

  
  
  


            
          </div>
        </div><!-- /.repohead -->

        <div id="js-repo-pjax-container" class="container context-loader-container" data-pjax-container>
          


<!-- blob contrib key: blob_contributors:v21:69fbea20d9f82849faeaa61c57cc3af6 -->
<!-- blob contrib frag key: views10/v8/blob_contributors:v21:69fbea20d9f82849faeaa61c57cc3af6 -->


<div id="slider">
    <div class="frame-meta">

      <p title="This is a placeholder element" class="js-history-link-replace hidden"></p>

        <div class="breadcrumb">
          <span class='bold'><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/vitch/jScrollPane" class="js-slide-to" data-branch="master" data-direction="back" itemscope="url"><span itemprop="title">jScrollPane</span></a></span></span><span class="separator"> / </span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/vitch/jScrollPane/tree/master/script" class="js-slide-to" data-branch="master" data-direction="back" itemscope="url"><span itemprop="title">script</span></a></span><span class="separator"> / </span><strong class="final-path">jquery.jscrollpane.js</strong> <span class="js-zeroclipboard zeroclipboard-button" data-clipboard-text="script/jquery.jscrollpane.js" data-copied-hint="copied!" title="copy to clipboard"><span class="mini-icon mini-icon-clipboard"></span></span>
        </div>

      <a href="/vitch/jScrollPane/find/master" class="js-slide-to" data-hotkey="t" style="display:none">Show File Finder</a>


        
  <div class="commit file-history-tease">
    <img class="main-avatar" height="24" src="https://secure.gravatar.com/avatar/a585fc1dada8a7e34f1fea1e133e66d5?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
    <span class="author"><a href="/vitch" rel="author">vitch</a></span>
    <time class="js-relative-date" datetime="2012-09-27T01:27:27-07:00" title="2012-09-27 01:27:27">September 27, 2012</time>
    <div class="commit-title">
        <a href="/vitch/jScrollPane/commit/38f2aa9db7fdf5f1247eeeaaacaf8506bb77cdcc" class="message">Added support for jQuery 1.8.</a>
    </div>

    <div class="participation">
      <p class="quickstat"><a href="#blob_contributors_box" rel="facebox"><strong>8</strong> contributors</a></p>
          <a class="avatar tooltipped downwards" title="vitch" href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js?author=vitch"><img height="20" src="https://secure.gravatar.com/avatar/a585fc1dada8a7e34f1fea1e133e66d5?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="aivopaas" href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js?author=aivopaas"><img height="20" src="https://secure.gravatar.com/avatar/38524bff020e6766c8768ba5a07708cc?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="ept" href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js?author=ept"><img height="20" src="https://secure.gravatar.com/avatar/0d4ef9af8e4f0cf5c162b48ba24faea6?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="aFarkas" href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js?author=aFarkas"><img height="20" src="https://secure.gravatar.com/avatar/5c4f4e081b98517cf7c5b21f47d9fe33?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="tim-sge" href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js?author=tim-sge"><img height="20" src="https://secure.gravatar.com/avatar/1706acaa86b2e90255fad127504f7c4f?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="brinley" href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js?author=brinley"><img height="20" src="https://secure.gravatar.com/avatar/52b9c2b93d20d3a5ae781208549fcffc?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="cmwelsh" href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js?author=cmwelsh"><img height="20" src="https://secure.gravatar.com/avatar/180b733d4fafbeb88f79aa4f11c79c66?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="yukulele" href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js?author=yukulele"><img height="20" src="https://secure.gravatar.com/avatar/d41d8cd98f00b204e9800998ecf8427e?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>


    </div>
    <div id="blob_contributors_box" style="display:none">
      <h2>Users on GitHub who have contributed to this file</h2>
      <ul class="facebox-user-list">
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/a585fc1dada8a7e34f1fea1e133e66d5?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/vitch">vitch</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/38524bff020e6766c8768ba5a07708cc?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/aivopaas">aivopaas</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/0d4ef9af8e4f0cf5c162b48ba24faea6?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/ept">ept</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/5c4f4e081b98517cf7c5b21f47d9fe33?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/aFarkas">aFarkas</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/1706acaa86b2e90255fad127504f7c4f?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/tim-sge">tim-sge</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/52b9c2b93d20d3a5ae781208549fcffc?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/brinley">brinley</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/180b733d4fafbeb88f79aa4f11c79c66?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/cmwelsh">cmwelsh</a>
        </li>
        <li>
          <img height="24" src="https://secure.gravatar.com/avatar/d41d8cd98f00b204e9800998ecf8427e?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/yukulele">yukulele</a>
        </li>
      </ul>
    </div>
  </div>


    </div><!-- ./.frame-meta -->

    <div class="frames">
      <div class="frame" data-permalink-url="/vitch/jScrollPane/blob/548347a0c38bbb649048f42bfede478f7bc64e00/script/jquery.jscrollpane.js" data-title="jScrollPane/script/jquery.jscrollpane.js at master · vitch/jScrollPane · GitHub" data-type="blob">

        <div id="files" class="bubble">
          <div class="file">
            <div class="meta">
              <div class="info">
                <span class="icon"><b class="mini-icon mini-icon-text-file"></b></span>
                <span class="mode" title="File Mode">file</span>
                  <span>1437 lines (1294 sloc)</span>
                <span>46.177 kb</span>
              </div>
              <div class="actions">
                <div class="button-group">
                      <a class="minibutton js-entice" href=""
                         data-entice="You must be signed in and on a branch to make or propose changes">Edit</a>
                  <a href="/vitch/jScrollPane/raw/master/script/jquery.jscrollpane.js" class="button minibutton " id="raw-url">Raw</a>
                    <a href="/vitch/jScrollPane/blame/master/script/jquery.jscrollpane.js" class="button minibutton ">Blame</a>
                  <a href="/vitch/jScrollPane/commits/master/script/jquery.jscrollpane.js" class="button minibutton " rel="nofollow">History</a>
                </div><!-- /.button-group -->
              </div><!-- /.actions -->

            </div>
                <div class="data type-javascript js-blob-data">
      <table cellpadding="0" cellspacing="0" class="lines">
        <tr>
          <td>
            <pre class="line_numbers"><span id="L1" rel="#L1">1</span>
<span id="L2" rel="#L2">2</span>
<span id="L3" rel="#L3">3</span>
<span id="L4" rel="#L4">4</span>
<span id="L5" rel="#L5">5</span>
<span id="L6" rel="#L6">6</span>
<span id="L7" rel="#L7">7</span>
<span id="L8" rel="#L8">8</span>
<span id="L9" rel="#L9">9</span>
<span id="L10" rel="#L10">10</span>
<span id="L11" rel="#L11">11</span>
<span id="L12" rel="#L12">12</span>
<span id="L13" rel="#L13">13</span>
<span id="L14" rel="#L14">14</span>
<span id="L15" rel="#L15">15</span>
<span id="L16" rel="#L16">16</span>
<span id="L17" rel="#L17">17</span>
<span id="L18" rel="#L18">18</span>
<span id="L19" rel="#L19">19</span>
<span id="L20" rel="#L20">20</span>
<span id="L21" rel="#L21">21</span>
<span id="L22" rel="#L22">22</span>
<span id="L23" rel="#L23">23</span>
<span id="L24" rel="#L24">24</span>
<span id="L25" rel="#L25">25</span>
<span id="L26" rel="#L26">26</span>
<span id="L27" rel="#L27">27</span>
<span id="L28" rel="#L28">28</span>
<span id="L29" rel="#L29">29</span>
<span id="L30" rel="#L30">30</span>
<span id="L31" rel="#L31">31</span>
<span id="L32" rel="#L32">32</span>
<span id="L33" rel="#L33">33</span>
<span id="L34" rel="#L34">34</span>
<span id="L35" rel="#L35">35</span>
<span id="L36" rel="#L36">36</span>
<span id="L37" rel="#L37">37</span>
<span id="L38" rel="#L38">38</span>
<span id="L39" rel="#L39">39</span>
<span id="L40" rel="#L40">40</span>
<span id="L41" rel="#L41">41</span>
<span id="L42" rel="#L42">42</span>
<span id="L43" rel="#L43">43</span>
<span id="L44" rel="#L44">44</span>
<span id="L45" rel="#L45">45</span>
<span id="L46" rel="#L46">46</span>
<span id="L47" rel="#L47">47</span>
<span id="L48" rel="#L48">48</span>
<span id="L49" rel="#L49">49</span>
<span id="L50" rel="#L50">50</span>
<span id="L51" rel="#L51">51</span>
<span id="L52" rel="#L52">52</span>
<span id="L53" rel="#L53">53</span>
<span id="L54" rel="#L54">54</span>
<span id="L55" rel="#L55">55</span>
<span id="L56" rel="#L56">56</span>
<span id="L57" rel="#L57">57</span>
<span id="L58" rel="#L58">58</span>
<span id="L59" rel="#L59">59</span>
<span id="L60" rel="#L60">60</span>
<span id="L61" rel="#L61">61</span>
<span id="L62" rel="#L62">62</span>
<span id="L63" rel="#L63">63</span>
<span id="L64" rel="#L64">64</span>
<span id="L65" rel="#L65">65</span>
<span id="L66" rel="#L66">66</span>
<span id="L67" rel="#L67">67</span>
<span id="L68" rel="#L68">68</span>
<span id="L69" rel="#L69">69</span>
<span id="L70" rel="#L70">70</span>
<span id="L71" rel="#L71">71</span>
<span id="L72" rel="#L72">72</span>
<span id="L73" rel="#L73">73</span>
<span id="L74" rel="#L74">74</span>
<span id="L75" rel="#L75">75</span>
<span id="L76" rel="#L76">76</span>
<span id="L77" rel="#L77">77</span>
<span id="L78" rel="#L78">78</span>
<span id="L79" rel="#L79">79</span>
<span id="L80" rel="#L80">80</span>
<span id="L81" rel="#L81">81</span>
<span id="L82" rel="#L82">82</span>
<span id="L83" rel="#L83">83</span>
<span id="L84" rel="#L84">84</span>
<span id="L85" rel="#L85">85</span>
<span id="L86" rel="#L86">86</span>
<span id="L87" rel="#L87">87</span>
<span id="L88" rel="#L88">88</span>
<span id="L89" rel="#L89">89</span>
<span id="L90" rel="#L90">90</span>
<span id="L91" rel="#L91">91</span>
<span id="L92" rel="#L92">92</span>
<span id="L93" rel="#L93">93</span>
<span id="L94" rel="#L94">94</span>
<span id="L95" rel="#L95">95</span>
<span id="L96" rel="#L96">96</span>
<span id="L97" rel="#L97">97</span>
<span id="L98" rel="#L98">98</span>
<span id="L99" rel="#L99">99</span>
<span id="L100" rel="#L100">100</span>
<span id="L101" rel="#L101">101</span>
<span id="L102" rel="#L102">102</span>
<span id="L103" rel="#L103">103</span>
<span id="L104" rel="#L104">104</span>
<span id="L105" rel="#L105">105</span>
<span id="L106" rel="#L106">106</span>
<span id="L107" rel="#L107">107</span>
<span id="L108" rel="#L108">108</span>
<span id="L109" rel="#L109">109</span>
<span id="L110" rel="#L110">110</span>
<span id="L111" rel="#L111">111</span>
<span id="L112" rel="#L112">112</span>
<span id="L113" rel="#L113">113</span>
<span id="L114" rel="#L114">114</span>
<span id="L115" rel="#L115">115</span>
<span id="L116" rel="#L116">116</span>
<span id="L117" rel="#L117">117</span>
<span id="L118" rel="#L118">118</span>
<span id="L119" rel="#L119">119</span>
<span id="L120" rel="#L120">120</span>
<span id="L121" rel="#L121">121</span>
<span id="L122" rel="#L122">122</span>
<span id="L123" rel="#L123">123</span>
<span id="L124" rel="#L124">124</span>
<span id="L125" rel="#L125">125</span>
<span id="L126" rel="#L126">126</span>
<span id="L127" rel="#L127">127</span>
<span id="L128" rel="#L128">128</span>
<span id="L129" rel="#L129">129</span>
<span id="L130" rel="#L130">130</span>
<span id="L131" rel="#L131">131</span>
<span id="L132" rel="#L132">132</span>
<span id="L133" rel="#L133">133</span>
<span id="L134" rel="#L134">134</span>
<span id="L135" rel="#L135">135</span>
<span id="L136" rel="#L136">136</span>
<span id="L137" rel="#L137">137</span>
<span id="L138" rel="#L138">138</span>
<span id="L139" rel="#L139">139</span>
<span id="L140" rel="#L140">140</span>
<span id="L141" rel="#L141">141</span>
<span id="L142" rel="#L142">142</span>
<span id="L143" rel="#L143">143</span>
<span id="L144" rel="#L144">144</span>
<span id="L145" rel="#L145">145</span>
<span id="L146" rel="#L146">146</span>
<span id="L147" rel="#L147">147</span>
<span id="L148" rel="#L148">148</span>
<span id="L149" rel="#L149">149</span>
<span id="L150" rel="#L150">150</span>
<span id="L151" rel="#L151">151</span>
<span id="L152" rel="#L152">152</span>
<span id="L153" rel="#L153">153</span>
<span id="L154" rel="#L154">154</span>
<span id="L155" rel="#L155">155</span>
<span id="L156" rel="#L156">156</span>
<span id="L157" rel="#L157">157</span>
<span id="L158" rel="#L158">158</span>
<span id="L159" rel="#L159">159</span>
<span id="L160" rel="#L160">160</span>
<span id="L161" rel="#L161">161</span>
<span id="L162" rel="#L162">162</span>
<span id="L163" rel="#L163">163</span>
<span id="L164" rel="#L164">164</span>
<span id="L165" rel="#L165">165</span>
<span id="L166" rel="#L166">166</span>
<span id="L167" rel="#L167">167</span>
<span id="L168" rel="#L168">168</span>
<span id="L169" rel="#L169">169</span>
<span id="L170" rel="#L170">170</span>
<span id="L171" rel="#L171">171</span>
<span id="L172" rel="#L172">172</span>
<span id="L173" rel="#L173">173</span>
<span id="L174" rel="#L174">174</span>
<span id="L175" rel="#L175">175</span>
<span id="L176" rel="#L176">176</span>
<span id="L177" rel="#L177">177</span>
<span id="L178" rel="#L178">178</span>
<span id="L179" rel="#L179">179</span>
<span id="L180" rel="#L180">180</span>
<span id="L181" rel="#L181">181</span>
<span id="L182" rel="#L182">182</span>
<span id="L183" rel="#L183">183</span>
<span id="L184" rel="#L184">184</span>
<span id="L185" rel="#L185">185</span>
<span id="L186" rel="#L186">186</span>
<span id="L187" rel="#L187">187</span>
<span id="L188" rel="#L188">188</span>
<span id="L189" rel="#L189">189</span>
<span id="L190" rel="#L190">190</span>
<span id="L191" rel="#L191">191</span>
<span id="L192" rel="#L192">192</span>
<span id="L193" rel="#L193">193</span>
<span id="L194" rel="#L194">194</span>
<span id="L195" rel="#L195">195</span>
<span id="L196" rel="#L196">196</span>
<span id="L197" rel="#L197">197</span>
<span id="L198" rel="#L198">198</span>
<span id="L199" rel="#L199">199</span>
<span id="L200" rel="#L200">200</span>
<span id="L201" rel="#L201">201</span>
<span id="L202" rel="#L202">202</span>
<span id="L203" rel="#L203">203</span>
<span id="L204" rel="#L204">204</span>
<span id="L205" rel="#L205">205</span>
<span id="L206" rel="#L206">206</span>
<span id="L207" rel="#L207">207</span>
<span id="L208" rel="#L208">208</span>
<span id="L209" rel="#L209">209</span>
<span id="L210" rel="#L210">210</span>
<span id="L211" rel="#L211">211</span>
<span id="L212" rel="#L212">212</span>
<span id="L213" rel="#L213">213</span>
<span id="L214" rel="#L214">214</span>
<span id="L215" rel="#L215">215</span>
<span id="L216" rel="#L216">216</span>
<span id="L217" rel="#L217">217</span>
<span id="L218" rel="#L218">218</span>
<span id="L219" rel="#L219">219</span>
<span id="L220" rel="#L220">220</span>
<span id="L221" rel="#L221">221</span>
<span id="L222" rel="#L222">222</span>
<span id="L223" rel="#L223">223</span>
<span id="L224" rel="#L224">224</span>
<span id="L225" rel="#L225">225</span>
<span id="L226" rel="#L226">226</span>
<span id="L227" rel="#L227">227</span>
<span id="L228" rel="#L228">228</span>
<span id="L229" rel="#L229">229</span>
<span id="L230" rel="#L230">230</span>
<span id="L231" rel="#L231">231</span>
<span id="L232" rel="#L232">232</span>
<span id="L233" rel="#L233">233</span>
<span id="L234" rel="#L234">234</span>
<span id="L235" rel="#L235">235</span>
<span id="L236" rel="#L236">236</span>
<span id="L237" rel="#L237">237</span>
<span id="L238" rel="#L238">238</span>
<span id="L239" rel="#L239">239</span>
<span id="L240" rel="#L240">240</span>
<span id="L241" rel="#L241">241</span>
<span id="L242" rel="#L242">242</span>
<span id="L243" rel="#L243">243</span>
<span id="L244" rel="#L244">244</span>
<span id="L245" rel="#L245">245</span>
<span id="L246" rel="#L246">246</span>
<span id="L247" rel="#L247">247</span>
<span id="L248" rel="#L248">248</span>
<span id="L249" rel="#L249">249</span>
<span id="L250" rel="#L250">250</span>
<span id="L251" rel="#L251">251</span>
<span id="L252" rel="#L252">252</span>
<span id="L253" rel="#L253">253</span>
<span id="L254" rel="#L254">254</span>
<span id="L255" rel="#L255">255</span>
<span id="L256" rel="#L256">256</span>
<span id="L257" rel="#L257">257</span>
<span id="L258" rel="#L258">258</span>
<span id="L259" rel="#L259">259</span>
<span id="L260" rel="#L260">260</span>
<span id="L261" rel="#L261">261</span>
<span id="L262" rel="#L262">262</span>
<span id="L263" rel="#L263">263</span>
<span id="L264" rel="#L264">264</span>
<span id="L265" rel="#L265">265</span>
<span id="L266" rel="#L266">266</span>
<span id="L267" rel="#L267">267</span>
<span id="L268" rel="#L268">268</span>
<span id="L269" rel="#L269">269</span>
<span id="L270" rel="#L270">270</span>
<span id="L271" rel="#L271">271</span>
<span id="L272" rel="#L272">272</span>
<span id="L273" rel="#L273">273</span>
<span id="L274" rel="#L274">274</span>
<span id="L275" rel="#L275">275</span>
<span id="L276" rel="#L276">276</span>
<span id="L277" rel="#L277">277</span>
<span id="L278" rel="#L278">278</span>
<span id="L279" rel="#L279">279</span>
<span id="L280" rel="#L280">280</span>
<span id="L281" rel="#L281">281</span>
<span id="L282" rel="#L282">282</span>
<span id="L283" rel="#L283">283</span>
<span id="L284" rel="#L284">284</span>
<span id="L285" rel="#L285">285</span>
<span id="L286" rel="#L286">286</span>
<span id="L287" rel="#L287">287</span>
<span id="L288" rel="#L288">288</span>
<span id="L289" rel="#L289">289</span>
<span id="L290" rel="#L290">290</span>
<span id="L291" rel="#L291">291</span>
<span id="L292" rel="#L292">292</span>
<span id="L293" rel="#L293">293</span>
<span id="L294" rel="#L294">294</span>
<span id="L295" rel="#L295">295</span>
<span id="L296" rel="#L296">296</span>
<span id="L297" rel="#L297">297</span>
<span id="L298" rel="#L298">298</span>
<span id="L299" rel="#L299">299</span>
<span id="L300" rel="#L300">300</span>
<span id="L301" rel="#L301">301</span>
<span id="L302" rel="#L302">302</span>
<span id="L303" rel="#L303">303</span>
<span id="L304" rel="#L304">304</span>
<span id="L305" rel="#L305">305</span>
<span id="L306" rel="#L306">306</span>
<span id="L307" rel="#L307">307</span>
<span id="L308" rel="#L308">308</span>
<span id="L309" rel="#L309">309</span>
<span id="L310" rel="#L310">310</span>
<span id="L311" rel="#L311">311</span>
<span id="L312" rel="#L312">312</span>
<span id="L313" rel="#L313">313</span>
<span id="L314" rel="#L314">314</span>
<span id="L315" rel="#L315">315</span>
<span id="L316" rel="#L316">316</span>
<span id="L317" rel="#L317">317</span>
<span id="L318" rel="#L318">318</span>
<span id="L319" rel="#L319">319</span>
<span id="L320" rel="#L320">320</span>
<span id="L321" rel="#L321">321</span>
<span id="L322" rel="#L322">322</span>
<span id="L323" rel="#L323">323</span>
<span id="L324" rel="#L324">324</span>
<span id="L325" rel="#L325">325</span>
<span id="L326" rel="#L326">326</span>
<span id="L327" rel="#L327">327</span>
<span id="L328" rel="#L328">328</span>
<span id="L329" rel="#L329">329</span>
<span id="L330" rel="#L330">330</span>
<span id="L331" rel="#L331">331</span>
<span id="L332" rel="#L332">332</span>
<span id="L333" rel="#L333">333</span>
<span id="L334" rel="#L334">334</span>
<span id="L335" rel="#L335">335</span>
<span id="L336" rel="#L336">336</span>
<span id="L337" rel="#L337">337</span>
<span id="L338" rel="#L338">338</span>
<span id="L339" rel="#L339">339</span>
<span id="L340" rel="#L340">340</span>
<span id="L341" rel="#L341">341</span>
<span id="L342" rel="#L342">342</span>
<span id="L343" rel="#L343">343</span>
<span id="L344" rel="#L344">344</span>
<span id="L345" rel="#L345">345</span>
<span id="L346" rel="#L346">346</span>
<span id="L347" rel="#L347">347</span>
<span id="L348" rel="#L348">348</span>
<span id="L349" rel="#L349">349</span>
<span id="L350" rel="#L350">350</span>
<span id="L351" rel="#L351">351</span>
<span id="L352" rel="#L352">352</span>
<span id="L353" rel="#L353">353</span>
<span id="L354" rel="#L354">354</span>
<span id="L355" rel="#L355">355</span>
<span id="L356" rel="#L356">356</span>
<span id="L357" rel="#L357">357</span>
<span id="L358" rel="#L358">358</span>
<span id="L359" rel="#L359">359</span>
<span id="L360" rel="#L360">360</span>
<span id="L361" rel="#L361">361</span>
<span id="L362" rel="#L362">362</span>
<span id="L363" rel="#L363">363</span>
<span id="L364" rel="#L364">364</span>
<span id="L365" rel="#L365">365</span>
<span id="L366" rel="#L366">366</span>
<span id="L367" rel="#L367">367</span>
<span id="L368" rel="#L368">368</span>
<span id="L369" rel="#L369">369</span>
<span id="L370" rel="#L370">370</span>
<span id="L371" rel="#L371">371</span>
<span id="L372" rel="#L372">372</span>
<span id="L373" rel="#L373">373</span>
<span id="L374" rel="#L374">374</span>
<span id="L375" rel="#L375">375</span>
<span id="L376" rel="#L376">376</span>
<span id="L377" rel="#L377">377</span>
<span id="L378" rel="#L378">378</span>
<span id="L379" rel="#L379">379</span>
<span id="L380" rel="#L380">380</span>
<span id="L381" rel="#L381">381</span>
<span id="L382" rel="#L382">382</span>
<span id="L383" rel="#L383">383</span>
<span id="L384" rel="#L384">384</span>
<span id="L385" rel="#L385">385</span>
<span id="L386" rel="#L386">386</span>
<span id="L387" rel="#L387">387</span>
<span id="L388" rel="#L388">388</span>
<span id="L389" rel="#L389">389</span>
<span id="L390" rel="#L390">390</span>
<span id="L391" rel="#L391">391</span>
<span id="L392" rel="#L392">392</span>
<span id="L393" rel="#L393">393</span>
<span id="L394" rel="#L394">394</span>
<span id="L395" rel="#L395">395</span>
<span id="L396" rel="#L396">396</span>
<span id="L397" rel="#L397">397</span>
<span id="L398" rel="#L398">398</span>
<span id="L399" rel="#L399">399</span>
<span id="L400" rel="#L400">400</span>
<span id="L401" rel="#L401">401</span>
<span id="L402" rel="#L402">402</span>
<span id="L403" rel="#L403">403</span>
<span id="L404" rel="#L404">404</span>
<span id="L405" rel="#L405">405</span>
<span id="L406" rel="#L406">406</span>
<span id="L407" rel="#L407">407</span>
<span id="L408" rel="#L408">408</span>
<span id="L409" rel="#L409">409</span>
<span id="L410" rel="#L410">410</span>
<span id="L411" rel="#L411">411</span>
<span id="L412" rel="#L412">412</span>
<span id="L413" rel="#L413">413</span>
<span id="L414" rel="#L414">414</span>
<span id="L415" rel="#L415">415</span>
<span id="L416" rel="#L416">416</span>
<span id="L417" rel="#L417">417</span>
<span id="L418" rel="#L418">418</span>
<span id="L419" rel="#L419">419</span>
<span id="L420" rel="#L420">420</span>
<span id="L421" rel="#L421">421</span>
<span id="L422" rel="#L422">422</span>
<span id="L423" rel="#L423">423</span>
<span id="L424" rel="#L424">424</span>
<span id="L425" rel="#L425">425</span>
<span id="L426" rel="#L426">426</span>
<span id="L427" rel="#L427">427</span>
<span id="L428" rel="#L428">428</span>
<span id="L429" rel="#L429">429</span>
<span id="L430" rel="#L430">430</span>
<span id="L431" rel="#L431">431</span>
<span id="L432" rel="#L432">432</span>
<span id="L433" rel="#L433">433</span>
<span id="L434" rel="#L434">434</span>
<span id="L435" rel="#L435">435</span>
<span id="L436" rel="#L436">436</span>
<span id="L437" rel="#L437">437</span>
<span id="L438" rel="#L438">438</span>
<span id="L439" rel="#L439">439</span>
<span id="L440" rel="#L440">440</span>
<span id="L441" rel="#L441">441</span>
<span id="L442" rel="#L442">442</span>
<span id="L443" rel="#L443">443</span>
<span id="L444" rel="#L444">444</span>
<span id="L445" rel="#L445">445</span>
<span id="L446" rel="#L446">446</span>
<span id="L447" rel="#L447">447</span>
<span id="L448" rel="#L448">448</span>
<span id="L449" rel="#L449">449</span>
<span id="L450" rel="#L450">450</span>
<span id="L451" rel="#L451">451</span>
<span id="L452" rel="#L452">452</span>
<span id="L453" rel="#L453">453</span>
<span id="L454" rel="#L454">454</span>
<span id="L455" rel="#L455">455</span>
<span id="L456" rel="#L456">456</span>
<span id="L457" rel="#L457">457</span>
<span id="L458" rel="#L458">458</span>
<span id="L459" rel="#L459">459</span>
<span id="L460" rel="#L460">460</span>
<span id="L461" rel="#L461">461</span>
<span id="L462" rel="#L462">462</span>
<span id="L463" rel="#L463">463</span>
<span id="L464" rel="#L464">464</span>
<span id="L465" rel="#L465">465</span>
<span id="L466" rel="#L466">466</span>
<span id="L467" rel="#L467">467</span>
<span id="L468" rel="#L468">468</span>
<span id="L469" rel="#L469">469</span>
<span id="L470" rel="#L470">470</span>
<span id="L471" rel="#L471">471</span>
<span id="L472" rel="#L472">472</span>
<span id="L473" rel="#L473">473</span>
<span id="L474" rel="#L474">474</span>
<span id="L475" rel="#L475">475</span>
<span id="L476" rel="#L476">476</span>
<span id="L477" rel="#L477">477</span>
<span id="L478" rel="#L478">478</span>
<span id="L479" rel="#L479">479</span>
<span id="L480" rel="#L480">480</span>
<span id="L481" rel="#L481">481</span>
<span id="L482" rel="#L482">482</span>
<span id="L483" rel="#L483">483</span>
<span id="L484" rel="#L484">484</span>
<span id="L485" rel="#L485">485</span>
<span id="L486" rel="#L486">486</span>
<span id="L487" rel="#L487">487</span>
<span id="L488" rel="#L488">488</span>
<span id="L489" rel="#L489">489</span>
<span id="L490" rel="#L490">490</span>
<span id="L491" rel="#L491">491</span>
<span id="L492" rel="#L492">492</span>
<span id="L493" rel="#L493">493</span>
<span id="L494" rel="#L494">494</span>
<span id="L495" rel="#L495">495</span>
<span id="L496" rel="#L496">496</span>
<span id="L497" rel="#L497">497</span>
<span id="L498" rel="#L498">498</span>
<span id="L499" rel="#L499">499</span>
<span id="L500" rel="#L500">500</span>
<span id="L501" rel="#L501">501</span>
<span id="L502" rel="#L502">502</span>
<span id="L503" rel="#L503">503</span>
<span id="L504" rel="#L504">504</span>
<span id="L505" rel="#L505">505</span>
<span id="L506" rel="#L506">506</span>
<span id="L507" rel="#L507">507</span>
<span id="L508" rel="#L508">508</span>
<span id="L509" rel="#L509">509</span>
<span id="L510" rel="#L510">510</span>
<span id="L511" rel="#L511">511</span>
<span id="L512" rel="#L512">512</span>
<span id="L513" rel="#L513">513</span>
<span id="L514" rel="#L514">514</span>
<span id="L515" rel="#L515">515</span>
<span id="L516" rel="#L516">516</span>
<span id="L517" rel="#L517">517</span>
<span id="L518" rel="#L518">518</span>
<span id="L519" rel="#L519">519</span>
<span id="L520" rel="#L520">520</span>
<span id="L521" rel="#L521">521</span>
<span id="L522" rel="#L522">522</span>
<span id="L523" rel="#L523">523</span>
<span id="L524" rel="#L524">524</span>
<span id="L525" rel="#L525">525</span>
<span id="L526" rel="#L526">526</span>
<span id="L527" rel="#L527">527</span>
<span id="L528" rel="#L528">528</span>
<span id="L529" rel="#L529">529</span>
<span id="L530" rel="#L530">530</span>
<span id="L531" rel="#L531">531</span>
<span id="L532" rel="#L532">532</span>
<span id="L533" rel="#L533">533</span>
<span id="L534" rel="#L534">534</span>
<span id="L535" rel="#L535">535</span>
<span id="L536" rel="#L536">536</span>
<span id="L537" rel="#L537">537</span>
<span id="L538" rel="#L538">538</span>
<span id="L539" rel="#L539">539</span>
<span id="L540" rel="#L540">540</span>
<span id="L541" rel="#L541">541</span>
<span id="L542" rel="#L542">542</span>
<span id="L543" rel="#L543">543</span>
<span id="L544" rel="#L544">544</span>
<span id="L545" rel="#L545">545</span>
<span id="L546" rel="#L546">546</span>
<span id="L547" rel="#L547">547</span>
<span id="L548" rel="#L548">548</span>
<span id="L549" rel="#L549">549</span>
<span id="L550" rel="#L550">550</span>
<span id="L551" rel="#L551">551</span>
<span id="L552" rel="#L552">552</span>
<span id="L553" rel="#L553">553</span>
<span id="L554" rel="#L554">554</span>
<span id="L555" rel="#L555">555</span>
<span id="L556" rel="#L556">556</span>
<span id="L557" rel="#L557">557</span>
<span id="L558" rel="#L558">558</span>
<span id="L559" rel="#L559">559</span>
<span id="L560" rel="#L560">560</span>
<span id="L561" rel="#L561">561</span>
<span id="L562" rel="#L562">562</span>
<span id="L563" rel="#L563">563</span>
<span id="L564" rel="#L564">564</span>
<span id="L565" rel="#L565">565</span>
<span id="L566" rel="#L566">566</span>
<span id="L567" rel="#L567">567</span>
<span id="L568" rel="#L568">568</span>
<span id="L569" rel="#L569">569</span>
<span id="L570" rel="#L570">570</span>
<span id="L571" rel="#L571">571</span>
<span id="L572" rel="#L572">572</span>
<span id="L573" rel="#L573">573</span>
<span id="L574" rel="#L574">574</span>
<span id="L575" rel="#L575">575</span>
<span id="L576" rel="#L576">576</span>
<span id="L577" rel="#L577">577</span>
<span id="L578" rel="#L578">578</span>
<span id="L579" rel="#L579">579</span>
<span id="L580" rel="#L580">580</span>
<span id="L581" rel="#L581">581</span>
<span id="L582" rel="#L582">582</span>
<span id="L583" rel="#L583">583</span>
<span id="L584" rel="#L584">584</span>
<span id="L585" rel="#L585">585</span>
<span id="L586" rel="#L586">586</span>
<span id="L587" rel="#L587">587</span>
<span id="L588" rel="#L588">588</span>
<span id="L589" rel="#L589">589</span>
<span id="L590" rel="#L590">590</span>
<span id="L591" rel="#L591">591</span>
<span id="L592" rel="#L592">592</span>
<span id="L593" rel="#L593">593</span>
<span id="L594" rel="#L594">594</span>
<span id="L595" rel="#L595">595</span>
<span id="L596" rel="#L596">596</span>
<span id="L597" rel="#L597">597</span>
<span id="L598" rel="#L598">598</span>
<span id="L599" rel="#L599">599</span>
<span id="L600" rel="#L600">600</span>
<span id="L601" rel="#L601">601</span>
<span id="L602" rel="#L602">602</span>
<span id="L603" rel="#L603">603</span>
<span id="L604" rel="#L604">604</span>
<span id="L605" rel="#L605">605</span>
<span id="L606" rel="#L606">606</span>
<span id="L607" rel="#L607">607</span>
<span id="L608" rel="#L608">608</span>
<span id="L609" rel="#L609">609</span>
<span id="L610" rel="#L610">610</span>
<span id="L611" rel="#L611">611</span>
<span id="L612" rel="#L612">612</span>
<span id="L613" rel="#L613">613</span>
<span id="L614" rel="#L614">614</span>
<span id="L615" rel="#L615">615</span>
<span id="L616" rel="#L616">616</span>
<span id="L617" rel="#L617">617</span>
<span id="L618" rel="#L618">618</span>
<span id="L619" rel="#L619">619</span>
<span id="L620" rel="#L620">620</span>
<span id="L621" rel="#L621">621</span>
<span id="L622" rel="#L622">622</span>
<span id="L623" rel="#L623">623</span>
<span id="L624" rel="#L624">624</span>
<span id="L625" rel="#L625">625</span>
<span id="L626" rel="#L626">626</span>
<span id="L627" rel="#L627">627</span>
<span id="L628" rel="#L628">628</span>
<span id="L629" rel="#L629">629</span>
<span id="L630" rel="#L630">630</span>
<span id="L631" rel="#L631">631</span>
<span id="L632" rel="#L632">632</span>
<span id="L633" rel="#L633">633</span>
<span id="L634" rel="#L634">634</span>
<span id="L635" rel="#L635">635</span>
<span id="L636" rel="#L636">636</span>
<span id="L637" rel="#L637">637</span>
<span id="L638" rel="#L638">638</span>
<span id="L639" rel="#L639">639</span>
<span id="L640" rel="#L640">640</span>
<span id="L641" rel="#L641">641</span>
<span id="L642" rel="#L642">642</span>
<span id="L643" rel="#L643">643</span>
<span id="L644" rel="#L644">644</span>
<span id="L645" rel="#L645">645</span>
<span id="L646" rel="#L646">646</span>
<span id="L647" rel="#L647">647</span>
<span id="L648" rel="#L648">648</span>
<span id="L649" rel="#L649">649</span>
<span id="L650" rel="#L650">650</span>
<span id="L651" rel="#L651">651</span>
<span id="L652" rel="#L652">652</span>
<span id="L653" rel="#L653">653</span>
<span id="L654" rel="#L654">654</span>
<span id="L655" rel="#L655">655</span>
<span id="L656" rel="#L656">656</span>
<span id="L657" rel="#L657">657</span>
<span id="L658" rel="#L658">658</span>
<span id="L659" rel="#L659">659</span>
<span id="L660" rel="#L660">660</span>
<span id="L661" rel="#L661">661</span>
<span id="L662" rel="#L662">662</span>
<span id="L663" rel="#L663">663</span>
<span id="L664" rel="#L664">664</span>
<span id="L665" rel="#L665">665</span>
<span id="L666" rel="#L666">666</span>
<span id="L667" rel="#L667">667</span>
<span id="L668" rel="#L668">668</span>
<span id="L669" rel="#L669">669</span>
<span id="L670" rel="#L670">670</span>
<span id="L671" rel="#L671">671</span>
<span id="L672" rel="#L672">672</span>
<span id="L673" rel="#L673">673</span>
<span id="L674" rel="#L674">674</span>
<span id="L675" rel="#L675">675</span>
<span id="L676" rel="#L676">676</span>
<span id="L677" rel="#L677">677</span>
<span id="L678" rel="#L678">678</span>
<span id="L679" rel="#L679">679</span>
<span id="L680" rel="#L680">680</span>
<span id="L681" rel="#L681">681</span>
<span id="L682" rel="#L682">682</span>
<span id="L683" rel="#L683">683</span>
<span id="L684" rel="#L684">684</span>
<span id="L685" rel="#L685">685</span>
<span id="L686" rel="#L686">686</span>
<span id="L687" rel="#L687">687</span>
<span id="L688" rel="#L688">688</span>
<span id="L689" rel="#L689">689</span>
<span id="L690" rel="#L690">690</span>
<span id="L691" rel="#L691">691</span>
<span id="L692" rel="#L692">692</span>
<span id="L693" rel="#L693">693</span>
<span id="L694" rel="#L694">694</span>
<span id="L695" rel="#L695">695</span>
<span id="L696" rel="#L696">696</span>
<span id="L697" rel="#L697">697</span>
<span id="L698" rel="#L698">698</span>
<span id="L699" rel="#L699">699</span>
<span id="L700" rel="#L700">700</span>
<span id="L701" rel="#L701">701</span>
<span id="L702" rel="#L702">702</span>
<span id="L703" rel="#L703">703</span>
<span id="L704" rel="#L704">704</span>
<span id="L705" rel="#L705">705</span>
<span id="L706" rel="#L706">706</span>
<span id="L707" rel="#L707">707</span>
<span id="L708" rel="#L708">708</span>
<span id="L709" rel="#L709">709</span>
<span id="L710" rel="#L710">710</span>
<span id="L711" rel="#L711">711</span>
<span id="L712" rel="#L712">712</span>
<span id="L713" rel="#L713">713</span>
<span id="L714" rel="#L714">714</span>
<span id="L715" rel="#L715">715</span>
<span id="L716" rel="#L716">716</span>
<span id="L717" rel="#L717">717</span>
<span id="L718" rel="#L718">718</span>
<span id="L719" rel="#L719">719</span>
<span id="L720" rel="#L720">720</span>
<span id="L721" rel="#L721">721</span>
<span id="L722" rel="#L722">722</span>
<span id="L723" rel="#L723">723</span>
<span id="L724" rel="#L724">724</span>
<span id="L725" rel="#L725">725</span>
<span id="L726" rel="#L726">726</span>
<span id="L727" rel="#L727">727</span>
<span id="L728" rel="#L728">728</span>
<span id="L729" rel="#L729">729</span>
<span id="L730" rel="#L730">730</span>
<span id="L731" rel="#L731">731</span>
<span id="L732" rel="#L732">732</span>
<span id="L733" rel="#L733">733</span>
<span id="L734" rel="#L734">734</span>
<span id="L735" rel="#L735">735</span>
<span id="L736" rel="#L736">736</span>
<span id="L737" rel="#L737">737</span>
<span id="L738" rel="#L738">738</span>
<span id="L739" rel="#L739">739</span>
<span id="L740" rel="#L740">740</span>
<span id="L741" rel="#L741">741</span>
<span id="L742" rel="#L742">742</span>
<span id="L743" rel="#L743">743</span>
<span id="L744" rel="#L744">744</span>
<span id="L745" rel="#L745">745</span>
<span id="L746" rel="#L746">746</span>
<span id="L747" rel="#L747">747</span>
<span id="L748" rel="#L748">748</span>
<span id="L749" rel="#L749">749</span>
<span id="L750" rel="#L750">750</span>
<span id="L751" rel="#L751">751</span>
<span id="L752" rel="#L752">752</span>
<span id="L753" rel="#L753">753</span>
<span id="L754" rel="#L754">754</span>
<span id="L755" rel="#L755">755</span>
<span id="L756" rel="#L756">756</span>
<span id="L757" rel="#L757">757</span>
<span id="L758" rel="#L758">758</span>
<span id="L759" rel="#L759">759</span>
<span id="L760" rel="#L760">760</span>
<span id="L761" rel="#L761">761</span>
<span id="L762" rel="#L762">762</span>
<span id="L763" rel="#L763">763</span>
<span id="L764" rel="#L764">764</span>
<span id="L765" rel="#L765">765</span>
<span id="L766" rel="#L766">766</span>
<span id="L767" rel="#L767">767</span>
<span id="L768" rel="#L768">768</span>
<span id="L769" rel="#L769">769</span>
<span id="L770" rel="#L770">770</span>
<span id="L771" rel="#L771">771</span>
<span id="L772" rel="#L772">772</span>
<span id="L773" rel="#L773">773</span>
<span id="L774" rel="#L774">774</span>
<span id="L775" rel="#L775">775</span>
<span id="L776" rel="#L776">776</span>
<span id="L777" rel="#L777">777</span>
<span id="L778" rel="#L778">778</span>
<span id="L779" rel="#L779">779</span>
<span id="L780" rel="#L780">780</span>
<span id="L781" rel="#L781">781</span>
<span id="L782" rel="#L782">782</span>
<span id="L783" rel="#L783">783</span>
<span id="L784" rel="#L784">784</span>
<span id="L785" rel="#L785">785</span>
<span id="L786" rel="#L786">786</span>
<span id="L787" rel="#L787">787</span>
<span id="L788" rel="#L788">788</span>
<span id="L789" rel="#L789">789</span>
<span id="L790" rel="#L790">790</span>
<span id="L791" rel="#L791">791</span>
<span id="L792" rel="#L792">792</span>
<span id="L793" rel="#L793">793</span>
<span id="L794" rel="#L794">794</span>
<span id="L795" rel="#L795">795</span>
<span id="L796" rel="#L796">796</span>
<span id="L797" rel="#L797">797</span>
<span id="L798" rel="#L798">798</span>
<span id="L799" rel="#L799">799</span>
<span id="L800" rel="#L800">800</span>
<span id="L801" rel="#L801">801</span>
<span id="L802" rel="#L802">802</span>
<span id="L803" rel="#L803">803</span>
<span id="L804" rel="#L804">804</span>
<span id="L805" rel="#L805">805</span>
<span id="L806" rel="#L806">806</span>
<span id="L807" rel="#L807">807</span>
<span id="L808" rel="#L808">808</span>
<span id="L809" rel="#L809">809</span>
<span id="L810" rel="#L810">810</span>
<span id="L811" rel="#L811">811</span>
<span id="L812" rel="#L812">812</span>
<span id="L813" rel="#L813">813</span>
<span id="L814" rel="#L814">814</span>
<span id="L815" rel="#L815">815</span>
<span id="L816" rel="#L816">816</span>
<span id="L817" rel="#L817">817</span>
<span id="L818" rel="#L818">818</span>
<span id="L819" rel="#L819">819</span>
<span id="L820" rel="#L820">820</span>
<span id="L821" rel="#L821">821</span>
<span id="L822" rel="#L822">822</span>
<span id="L823" rel="#L823">823</span>
<span id="L824" rel="#L824">824</span>
<span id="L825" rel="#L825">825</span>
<span id="L826" rel="#L826">826</span>
<span id="L827" rel="#L827">827</span>
<span id="L828" rel="#L828">828</span>
<span id="L829" rel="#L829">829</span>
<span id="L830" rel="#L830">830</span>
<span id="L831" rel="#L831">831</span>
<span id="L832" rel="#L832">832</span>
<span id="L833" rel="#L833">833</span>
<span id="L834" rel="#L834">834</span>
<span id="L835" rel="#L835">835</span>
<span id="L836" rel="#L836">836</span>
<span id="L837" rel="#L837">837</span>
<span id="L838" rel="#L838">838</span>
<span id="L839" rel="#L839">839</span>
<span id="L840" rel="#L840">840</span>
<span id="L841" rel="#L841">841</span>
<span id="L842" rel="#L842">842</span>
<span id="L843" rel="#L843">843</span>
<span id="L844" rel="#L844">844</span>
<span id="L845" rel="#L845">845</span>
<span id="L846" rel="#L846">846</span>
<span id="L847" rel="#L847">847</span>
<span id="L848" rel="#L848">848</span>
<span id="L849" rel="#L849">849</span>
<span id="L850" rel="#L850">850</span>
<span id="L851" rel="#L851">851</span>
<span id="L852" rel="#L852">852</span>
<span id="L853" rel="#L853">853</span>
<span id="L854" rel="#L854">854</span>
<span id="L855" rel="#L855">855</span>
<span id="L856" rel="#L856">856</span>
<span id="L857" rel="#L857">857</span>
<span id="L858" rel="#L858">858</span>
<span id="L859" rel="#L859">859</span>
<span id="L860" rel="#L860">860</span>
<span id="L861" rel="#L861">861</span>
<span id="L862" rel="#L862">862</span>
<span id="L863" rel="#L863">863</span>
<span id="L864" rel="#L864">864</span>
<span id="L865" rel="#L865">865</span>
<span id="L866" rel="#L866">866</span>
<span id="L867" rel="#L867">867</span>
<span id="L868" rel="#L868">868</span>
<span id="L869" rel="#L869">869</span>
<span id="L870" rel="#L870">870</span>
<span id="L871" rel="#L871">871</span>
<span id="L872" rel="#L872">872</span>
<span id="L873" rel="#L873">873</span>
<span id="L874" rel="#L874">874</span>
<span id="L875" rel="#L875">875</span>
<span id="L876" rel="#L876">876</span>
<span id="L877" rel="#L877">877</span>
<span id="L878" rel="#L878">878</span>
<span id="L879" rel="#L879">879</span>
<span id="L880" rel="#L880">880</span>
<span id="L881" rel="#L881">881</span>
<span id="L882" rel="#L882">882</span>
<span id="L883" rel="#L883">883</span>
<span id="L884" rel="#L884">884</span>
<span id="L885" rel="#L885">885</span>
<span id="L886" rel="#L886">886</span>
<span id="L887" rel="#L887">887</span>
<span id="L888" rel="#L888">888</span>
<span id="L889" rel="#L889">889</span>
<span id="L890" rel="#L890">890</span>
<span id="L891" rel="#L891">891</span>
<span id="L892" rel="#L892">892</span>
<span id="L893" rel="#L893">893</span>
<span id="L894" rel="#L894">894</span>
<span id="L895" rel="#L895">895</span>
<span id="L896" rel="#L896">896</span>
<span id="L897" rel="#L897">897</span>
<span id="L898" rel="#L898">898</span>
<span id="L899" rel="#L899">899</span>
<span id="L900" rel="#L900">900</span>
<span id="L901" rel="#L901">901</span>
<span id="L902" rel="#L902">902</span>
<span id="L903" rel="#L903">903</span>
<span id="L904" rel="#L904">904</span>
<span id="L905" rel="#L905">905</span>
<span id="L906" rel="#L906">906</span>
<span id="L907" rel="#L907">907</span>
<span id="L908" rel="#L908">908</span>
<span id="L909" rel="#L909">909</span>
<span id="L910" rel="#L910">910</span>
<span id="L911" rel="#L911">911</span>
<span id="L912" rel="#L912">912</span>
<span id="L913" rel="#L913">913</span>
<span id="L914" rel="#L914">914</span>
<span id="L915" rel="#L915">915</span>
<span id="L916" rel="#L916">916</span>
<span id="L917" rel="#L917">917</span>
<span id="L918" rel="#L918">918</span>
<span id="L919" rel="#L919">919</span>
<span id="L920" rel="#L920">920</span>
<span id="L921" rel="#L921">921</span>
<span id="L922" rel="#L922">922</span>
<span id="L923" rel="#L923">923</span>
<span id="L924" rel="#L924">924</span>
<span id="L925" rel="#L925">925</span>
<span id="L926" rel="#L926">926</span>
<span id="L927" rel="#L927">927</span>
<span id="L928" rel="#L928">928</span>
<span id="L929" rel="#L929">929</span>
<span id="L930" rel="#L930">930</span>
<span id="L931" rel="#L931">931</span>
<span id="L932" rel="#L932">932</span>
<span id="L933" rel="#L933">933</span>
<span id="L934" rel="#L934">934</span>
<span id="L935" rel="#L935">935</span>
<span id="L936" rel="#L936">936</span>
<span id="L937" rel="#L937">937</span>
<span id="L938" rel="#L938">938</span>
<span id="L939" rel="#L939">939</span>
<span id="L940" rel="#L940">940</span>
<span id="L941" rel="#L941">941</span>
<span id="L942" rel="#L942">942</span>
<span id="L943" rel="#L943">943</span>
<span id="L944" rel="#L944">944</span>
<span id="L945" rel="#L945">945</span>
<span id="L946" rel="#L946">946</span>
<span id="L947" rel="#L947">947</span>
<span id="L948" rel="#L948">948</span>
<span id="L949" rel="#L949">949</span>
<span id="L950" rel="#L950">950</span>
<span id="L951" rel="#L951">951</span>
<span id="L952" rel="#L952">952</span>
<span id="L953" rel="#L953">953</span>
<span id="L954" rel="#L954">954</span>
<span id="L955" rel="#L955">955</span>
<span id="L956" rel="#L956">956</span>
<span id="L957" rel="#L957">957</span>
<span id="L958" rel="#L958">958</span>
<span id="L959" rel="#L959">959</span>
<span id="L960" rel="#L960">960</span>
<span id="L961" rel="#L961">961</span>
<span id="L962" rel="#L962">962</span>
<span id="L963" rel="#L963">963</span>
<span id="L964" rel="#L964">964</span>
<span id="L965" rel="#L965">965</span>
<span id="L966" rel="#L966">966</span>
<span id="L967" rel="#L967">967</span>
<span id="L968" rel="#L968">968</span>
<span id="L969" rel="#L969">969</span>
<span id="L970" rel="#L970">970</span>
<span id="L971" rel="#L971">971</span>
<span id="L972" rel="#L972">972</span>
<span id="L973" rel="#L973">973</span>
<span id="L974" rel="#L974">974</span>
<span id="L975" rel="#L975">975</span>
<span id="L976" rel="#L976">976</span>
<span id="L977" rel="#L977">977</span>
<span id="L978" rel="#L978">978</span>
<span id="L979" rel="#L979">979</span>
<span id="L980" rel="#L980">980</span>
<span id="L981" rel="#L981">981</span>
<span id="L982" rel="#L982">982</span>
<span id="L983" rel="#L983">983</span>
<span id="L984" rel="#L984">984</span>
<span id="L985" rel="#L985">985</span>
<span id="L986" rel="#L986">986</span>
<span id="L987" rel="#L987">987</span>
<span id="L988" rel="#L988">988</span>
<span id="L989" rel="#L989">989</span>
<span id="L990" rel="#L990">990</span>
<span id="L991" rel="#L991">991</span>
<span id="L992" rel="#L992">992</span>
<span id="L993" rel="#L993">993</span>
<span id="L994" rel="#L994">994</span>
<span id="L995" rel="#L995">995</span>
<span id="L996" rel="#L996">996</span>
<span id="L997" rel="#L997">997</span>
<span id="L998" rel="#L998">998</span>
<span id="L999" rel="#L999">999</span>
<span id="L1000" rel="#L1000">1000</span>
<span id="L1001" rel="#L1001">1001</span>
<span id="L1002" rel="#L1002">1002</span>
<span id="L1003" rel="#L1003">1003</span>
<span id="L1004" rel="#L1004">1004</span>
<span id="L1005" rel="#L1005">1005</span>
<span id="L1006" rel="#L1006">1006</span>
<span id="L1007" rel="#L1007">1007</span>
<span id="L1008" rel="#L1008">1008</span>
<span id="L1009" rel="#L1009">1009</span>
<span id="L1010" rel="#L1010">1010</span>
<span id="L1011" rel="#L1011">1011</span>
<span id="L1012" rel="#L1012">1012</span>
<span id="L1013" rel="#L1013">1013</span>
<span id="L1014" rel="#L1014">1014</span>
<span id="L1015" rel="#L1015">1015</span>
<span id="L1016" rel="#L1016">1016</span>
<span id="L1017" rel="#L1017">1017</span>
<span id="L1018" rel="#L1018">1018</span>
<span id="L1019" rel="#L1019">1019</span>
<span id="L1020" rel="#L1020">1020</span>
<span id="L1021" rel="#L1021">1021</span>
<span id="L1022" rel="#L1022">1022</span>
<span id="L1023" rel="#L1023">1023</span>
<span id="L1024" rel="#L1024">1024</span>
<span id="L1025" rel="#L1025">1025</span>
<span id="L1026" rel="#L1026">1026</span>
<span id="L1027" rel="#L1027">1027</span>
<span id="L1028" rel="#L1028">1028</span>
<span id="L1029" rel="#L1029">1029</span>
<span id="L1030" rel="#L1030">1030</span>
<span id="L1031" rel="#L1031">1031</span>
<span id="L1032" rel="#L1032">1032</span>
<span id="L1033" rel="#L1033">1033</span>
<span id="L1034" rel="#L1034">1034</span>
<span id="L1035" rel="#L1035">1035</span>
<span id="L1036" rel="#L1036">1036</span>
<span id="L1037" rel="#L1037">1037</span>
<span id="L1038" rel="#L1038">1038</span>
<span id="L1039" rel="#L1039">1039</span>
<span id="L1040" rel="#L1040">1040</span>
<span id="L1041" rel="#L1041">1041</span>
<span id="L1042" rel="#L1042">1042</span>
<span id="L1043" rel="#L1043">1043</span>
<span id="L1044" rel="#L1044">1044</span>
<span id="L1045" rel="#L1045">1045</span>
<span id="L1046" rel="#L1046">1046</span>
<span id="L1047" rel="#L1047">1047</span>
<span id="L1048" rel="#L1048">1048</span>
<span id="L1049" rel="#L1049">1049</span>
<span id="L1050" rel="#L1050">1050</span>
<span id="L1051" rel="#L1051">1051</span>
<span id="L1052" rel="#L1052">1052</span>
<span id="L1053" rel="#L1053">1053</span>
<span id="L1054" rel="#L1054">1054</span>
<span id="L1055" rel="#L1055">1055</span>
<span id="L1056" rel="#L1056">1056</span>
<span id="L1057" rel="#L1057">1057</span>
<span id="L1058" rel="#L1058">1058</span>
<span id="L1059" rel="#L1059">1059</span>
<span id="L1060" rel="#L1060">1060</span>
<span id="L1061" rel="#L1061">1061</span>
<span id="L1062" rel="#L1062">1062</span>
<span id="L1063" rel="#L1063">1063</span>
<span id="L1064" rel="#L1064">1064</span>
<span id="L1065" rel="#L1065">1065</span>
<span id="L1066" rel="#L1066">1066</span>
<span id="L1067" rel="#L1067">1067</span>
<span id="L1068" rel="#L1068">1068</span>
<span id="L1069" rel="#L1069">1069</span>
<span id="L1070" rel="#L1070">1070</span>
<span id="L1071" rel="#L1071">1071</span>
<span id="L1072" rel="#L1072">1072</span>
<span id="L1073" rel="#L1073">1073</span>
<span id="L1074" rel="#L1074">1074</span>
<span id="L1075" rel="#L1075">1075</span>
<span id="L1076" rel="#L1076">1076</span>
<span id="L1077" rel="#L1077">1077</span>
<span id="L1078" rel="#L1078">1078</span>
<span id="L1079" rel="#L1079">1079</span>
<span id="L1080" rel="#L1080">1080</span>
<span id="L1081" rel="#L1081">1081</span>
<span id="L1082" rel="#L1082">1082</span>
<span id="L1083" rel="#L1083">1083</span>
<span id="L1084" rel="#L1084">1084</span>
<span id="L1085" rel="#L1085">1085</span>
<span id="L1086" rel="#L1086">1086</span>
<span id="L1087" rel="#L1087">1087</span>
<span id="L1088" rel="#L1088">1088</span>
<span id="L1089" rel="#L1089">1089</span>
<span id="L1090" rel="#L1090">1090</span>
<span id="L1091" rel="#L1091">1091</span>
<span id="L1092" rel="#L1092">1092</span>
<span id="L1093" rel="#L1093">1093</span>
<span id="L1094" rel="#L1094">1094</span>
<span id="L1095" rel="#L1095">1095</span>
<span id="L1096" rel="#L1096">1096</span>
<span id="L1097" rel="#L1097">1097</span>
<span id="L1098" rel="#L1098">1098</span>
<span id="L1099" rel="#L1099">1099</span>
<span id="L1100" rel="#L1100">1100</span>
<span id="L1101" rel="#L1101">1101</span>
<span id="L1102" rel="#L1102">1102</span>
<span id="L1103" rel="#L1103">1103</span>
<span id="L1104" rel="#L1104">1104</span>
<span id="L1105" rel="#L1105">1105</span>
<span id="L1106" rel="#L1106">1106</span>
<span id="L1107" rel="#L1107">1107</span>
<span id="L1108" rel="#L1108">1108</span>
<span id="L1109" rel="#L1109">1109</span>
<span id="L1110" rel="#L1110">1110</span>
<span id="L1111" rel="#L1111">1111</span>
<span id="L1112" rel="#L1112">1112</span>
<span id="L1113" rel="#L1113">1113</span>
<span id="L1114" rel="#L1114">1114</span>
<span id="L1115" rel="#L1115">1115</span>
<span id="L1116" rel="#L1116">1116</span>
<span id="L1117" rel="#L1117">1117</span>
<span id="L1118" rel="#L1118">1118</span>
<span id="L1119" rel="#L1119">1119</span>
<span id="L1120" rel="#L1120">1120</span>
<span id="L1121" rel="#L1121">1121</span>
<span id="L1122" rel="#L1122">1122</span>
<span id="L1123" rel="#L1123">1123</span>
<span id="L1124" rel="#L1124">1124</span>
<span id="L1125" rel="#L1125">1125</span>
<span id="L1126" rel="#L1126">1126</span>
<span id="L1127" rel="#L1127">1127</span>
<span id="L1128" rel="#L1128">1128</span>
<span id="L1129" rel="#L1129">1129</span>
<span id="L1130" rel="#L1130">1130</span>
<span id="L1131" rel="#L1131">1131</span>
<span id="L1132" rel="#L1132">1132</span>
<span id="L1133" rel="#L1133">1133</span>
<span id="L1134" rel="#L1134">1134</span>
<span id="L1135" rel="#L1135">1135</span>
<span id="L1136" rel="#L1136">1136</span>
<span id="L1137" rel="#L1137">1137</span>
<span id="L1138" rel="#L1138">1138</span>
<span id="L1139" rel="#L1139">1139</span>
<span id="L1140" rel="#L1140">1140</span>
<span id="L1141" rel="#L1141">1141</span>
<span id="L1142" rel="#L1142">1142</span>
<span id="L1143" rel="#L1143">1143</span>
<span id="L1144" rel="#L1144">1144</span>
<span id="L1145" rel="#L1145">1145</span>
<span id="L1146" rel="#L1146">1146</span>
<span id="L1147" rel="#L1147">1147</span>
<span id="L1148" rel="#L1148">1148</span>
<span id="L1149" rel="#L1149">1149</span>
<span id="L1150" rel="#L1150">1150</span>
<span id="L1151" rel="#L1151">1151</span>
<span id="L1152" rel="#L1152">1152</span>
<span id="L1153" rel="#L1153">1153</span>
<span id="L1154" rel="#L1154">1154</span>
<span id="L1155" rel="#L1155">1155</span>
<span id="L1156" rel="#L1156">1156</span>
<span id="L1157" rel="#L1157">1157</span>
<span id="L1158" rel="#L1158">1158</span>
<span id="L1159" rel="#L1159">1159</span>
<span id="L1160" rel="#L1160">1160</span>
<span id="L1161" rel="#L1161">1161</span>
<span id="L1162" rel="#L1162">1162</span>
<span id="L1163" rel="#L1163">1163</span>
<span id="L1164" rel="#L1164">1164</span>
<span id="L1165" rel="#L1165">1165</span>
<span id="L1166" rel="#L1166">1166</span>
<span id="L1167" rel="#L1167">1167</span>
<span id="L1168" rel="#L1168">1168</span>
<span id="L1169" rel="#L1169">1169</span>
<span id="L1170" rel="#L1170">1170</span>
<span id="L1171" rel="#L1171">1171</span>
<span id="L1172" rel="#L1172">1172</span>
<span id="L1173" rel="#L1173">1173</span>
<span id="L1174" rel="#L1174">1174</span>
<span id="L1175" rel="#L1175">1175</span>
<span id="L1176" rel="#L1176">1176</span>
<span id="L1177" rel="#L1177">1177</span>
<span id="L1178" rel="#L1178">1178</span>
<span id="L1179" rel="#L1179">1179</span>
<span id="L1180" rel="#L1180">1180</span>
<span id="L1181" rel="#L1181">1181</span>
<span id="L1182" rel="#L1182">1182</span>
<span id="L1183" rel="#L1183">1183</span>
<span id="L1184" rel="#L1184">1184</span>
<span id="L1185" rel="#L1185">1185</span>
<span id="L1186" rel="#L1186">1186</span>
<span id="L1187" rel="#L1187">1187</span>
<span id="L1188" rel="#L1188">1188</span>
<span id="L1189" rel="#L1189">1189</span>
<span id="L1190" rel="#L1190">1190</span>
<span id="L1191" rel="#L1191">1191</span>
<span id="L1192" rel="#L1192">1192</span>
<span id="L1193" rel="#L1193">1193</span>
<span id="L1194" rel="#L1194">1194</span>
<span id="L1195" rel="#L1195">1195</span>
<span id="L1196" rel="#L1196">1196</span>
<span id="L1197" rel="#L1197">1197</span>
<span id="L1198" rel="#L1198">1198</span>
<span id="L1199" rel="#L1199">1199</span>
<span id="L1200" rel="#L1200">1200</span>
<span id="L1201" rel="#L1201">1201</span>
<span id="L1202" rel="#L1202">1202</span>
<span id="L1203" rel="#L1203">1203</span>
<span id="L1204" rel="#L1204">1204</span>
<span id="L1205" rel="#L1205">1205</span>
<span id="L1206" rel="#L1206">1206</span>
<span id="L1207" rel="#L1207">1207</span>
<span id="L1208" rel="#L1208">1208</span>
<span id="L1209" rel="#L1209">1209</span>
<span id="L1210" rel="#L1210">1210</span>
<span id="L1211" rel="#L1211">1211</span>
<span id="L1212" rel="#L1212">1212</span>
<span id="L1213" rel="#L1213">1213</span>
<span id="L1214" rel="#L1214">1214</span>
<span id="L1215" rel="#L1215">1215</span>
<span id="L1216" rel="#L1216">1216</span>
<span id="L1217" rel="#L1217">1217</span>
<span id="L1218" rel="#L1218">1218</span>
<span id="L1219" rel="#L1219">1219</span>
<span id="L1220" rel="#L1220">1220</span>
<span id="L1221" rel="#L1221">1221</span>
<span id="L1222" rel="#L1222">1222</span>
<span id="L1223" rel="#L1223">1223</span>
<span id="L1224" rel="#L1224">1224</span>
<span id="L1225" rel="#L1225">1225</span>
<span id="L1226" rel="#L1226">1226</span>
<span id="L1227" rel="#L1227">1227</span>
<span id="L1228" rel="#L1228">1228</span>
<span id="L1229" rel="#L1229">1229</span>
<span id="L1230" rel="#L1230">1230</span>
<span id="L1231" rel="#L1231">1231</span>
<span id="L1232" rel="#L1232">1232</span>
<span id="L1233" rel="#L1233">1233</span>
<span id="L1234" rel="#L1234">1234</span>
<span id="L1235" rel="#L1235">1235</span>
<span id="L1236" rel="#L1236">1236</span>
<span id="L1237" rel="#L1237">1237</span>
<span id="L1238" rel="#L1238">1238</span>
<span id="L1239" rel="#L1239">1239</span>
<span id="L1240" rel="#L1240">1240</span>
<span id="L1241" rel="#L1241">1241</span>
<span id="L1242" rel="#L1242">1242</span>
<span id="L1243" rel="#L1243">1243</span>
<span id="L1244" rel="#L1244">1244</span>
<span id="L1245" rel="#L1245">1245</span>
<span id="L1246" rel="#L1246">1246</span>
<span id="L1247" rel="#L1247">1247</span>
<span id="L1248" rel="#L1248">1248</span>
<span id="L1249" rel="#L1249">1249</span>
<span id="L1250" rel="#L1250">1250</span>
<span id="L1251" rel="#L1251">1251</span>
<span id="L1252" rel="#L1252">1252</span>
<span id="L1253" rel="#L1253">1253</span>
<span id="L1254" rel="#L1254">1254</span>
<span id="L1255" rel="#L1255">1255</span>
<span id="L1256" rel="#L1256">1256</span>
<span id="L1257" rel="#L1257">1257</span>
<span id="L1258" rel="#L1258">1258</span>
<span id="L1259" rel="#L1259">1259</span>
<span id="L1260" rel="#L1260">1260</span>
<span id="L1261" rel="#L1261">1261</span>
<span id="L1262" rel="#L1262">1262</span>
<span id="L1263" rel="#L1263">1263</span>
<span id="L1264" rel="#L1264">1264</span>
<span id="L1265" rel="#L1265">1265</span>
<span id="L1266" rel="#L1266">1266</span>
<span id="L1267" rel="#L1267">1267</span>
<span id="L1268" rel="#L1268">1268</span>
<span id="L1269" rel="#L1269">1269</span>
<span id="L1270" rel="#L1270">1270</span>
<span id="L1271" rel="#L1271">1271</span>
<span id="L1272" rel="#L1272">1272</span>
<span id="L1273" rel="#L1273">1273</span>
<span id="L1274" rel="#L1274">1274</span>
<span id="L1275" rel="#L1275">1275</span>
<span id="L1276" rel="#L1276">1276</span>
<span id="L1277" rel="#L1277">1277</span>
<span id="L1278" rel="#L1278">1278</span>
<span id="L1279" rel="#L1279">1279</span>
<span id="L1280" rel="#L1280">1280</span>
<span id="L1281" rel="#L1281">1281</span>
<span id="L1282" rel="#L1282">1282</span>
<span id="L1283" rel="#L1283">1283</span>
<span id="L1284" rel="#L1284">1284</span>
<span id="L1285" rel="#L1285">1285</span>
<span id="L1286" rel="#L1286">1286</span>
<span id="L1287" rel="#L1287">1287</span>
<span id="L1288" rel="#L1288">1288</span>
<span id="L1289" rel="#L1289">1289</span>
<span id="L1290" rel="#L1290">1290</span>
<span id="L1291" rel="#L1291">1291</span>
<span id="L1292" rel="#L1292">1292</span>
<span id="L1293" rel="#L1293">1293</span>
<span id="L1294" rel="#L1294">1294</span>
<span id="L1295" rel="#L1295">1295</span>
<span id="L1296" rel="#L1296">1296</span>
<span id="L1297" rel="#L1297">1297</span>
<span id="L1298" rel="#L1298">1298</span>
<span id="L1299" rel="#L1299">1299</span>
<span id="L1300" rel="#L1300">1300</span>
<span id="L1301" rel="#L1301">1301</span>
<span id="L1302" rel="#L1302">1302</span>
<span id="L1303" rel="#L1303">1303</span>
<span id="L1304" rel="#L1304">1304</span>
<span id="L1305" rel="#L1305">1305</span>
<span id="L1306" rel="#L1306">1306</span>
<span id="L1307" rel="#L1307">1307</span>
<span id="L1308" rel="#L1308">1308</span>
<span id="L1309" rel="#L1309">1309</span>
<span id="L1310" rel="#L1310">1310</span>
<span id="L1311" rel="#L1311">1311</span>
<span id="L1312" rel="#L1312">1312</span>
<span id="L1313" rel="#L1313">1313</span>
<span id="L1314" rel="#L1314">1314</span>
<span id="L1315" rel="#L1315">1315</span>
<span id="L1316" rel="#L1316">1316</span>
<span id="L1317" rel="#L1317">1317</span>
<span id="L1318" rel="#L1318">1318</span>
<span id="L1319" rel="#L1319">1319</span>
<span id="L1320" rel="#L1320">1320</span>
<span id="L1321" rel="#L1321">1321</span>
<span id="L1322" rel="#L1322">1322</span>
<span id="L1323" rel="#L1323">1323</span>
<span id="L1324" rel="#L1324">1324</span>
<span id="L1325" rel="#L1325">1325</span>
<span id="L1326" rel="#L1326">1326</span>
<span id="L1327" rel="#L1327">1327</span>
<span id="L1328" rel="#L1328">1328</span>
<span id="L1329" rel="#L1329">1329</span>
<span id="L1330" rel="#L1330">1330</span>
<span id="L1331" rel="#L1331">1331</span>
<span id="L1332" rel="#L1332">1332</span>
<span id="L1333" rel="#L1333">1333</span>
<span id="L1334" rel="#L1334">1334</span>
<span id="L1335" rel="#L1335">1335</span>
<span id="L1336" rel="#L1336">1336</span>
<span id="L1337" rel="#L1337">1337</span>
<span id="L1338" rel="#L1338">1338</span>
<span id="L1339" rel="#L1339">1339</span>
<span id="L1340" rel="#L1340">1340</span>
<span id="L1341" rel="#L1341">1341</span>
<span id="L1342" rel="#L1342">1342</span>
<span id="L1343" rel="#L1343">1343</span>
<span id="L1344" rel="#L1344">1344</span>
<span id="L1345" rel="#L1345">1345</span>
<span id="L1346" rel="#L1346">1346</span>
<span id="L1347" rel="#L1347">1347</span>
<span id="L1348" rel="#L1348">1348</span>
<span id="L1349" rel="#L1349">1349</span>
<span id="L1350" rel="#L1350">1350</span>
<span id="L1351" rel="#L1351">1351</span>
<span id="L1352" rel="#L1352">1352</span>
<span id="L1353" rel="#L1353">1353</span>
<span id="L1354" rel="#L1354">1354</span>
<span id="L1355" rel="#L1355">1355</span>
<span id="L1356" rel="#L1356">1356</span>
<span id="L1357" rel="#L1357">1357</span>
<span id="L1358" rel="#L1358">1358</span>
<span id="L1359" rel="#L1359">1359</span>
<span id="L1360" rel="#L1360">1360</span>
<span id="L1361" rel="#L1361">1361</span>
<span id="L1362" rel="#L1362">1362</span>
<span id="L1363" rel="#L1363">1363</span>
<span id="L1364" rel="#L1364">1364</span>
<span id="L1365" rel="#L1365">1365</span>
<span id="L1366" rel="#L1366">1366</span>
<span id="L1367" rel="#L1367">1367</span>
<span id="L1368" rel="#L1368">1368</span>
<span id="L1369" rel="#L1369">1369</span>
<span id="L1370" rel="#L1370">1370</span>
<span id="L1371" rel="#L1371">1371</span>
<span id="L1372" rel="#L1372">1372</span>
<span id="L1373" rel="#L1373">1373</span>
<span id="L1374" rel="#L1374">1374</span>
<span id="L1375" rel="#L1375">1375</span>
<span id="L1376" rel="#L1376">1376</span>
<span id="L1377" rel="#L1377">1377</span>
<span id="L1378" rel="#L1378">1378</span>
<span id="L1379" rel="#L1379">1379</span>
<span id="L1380" rel="#L1380">1380</span>
<span id="L1381" rel="#L1381">1381</span>
<span id="L1382" rel="#L1382">1382</span>
<span id="L1383" rel="#L1383">1383</span>
<span id="L1384" rel="#L1384">1384</span>
<span id="L1385" rel="#L1385">1385</span>
<span id="L1386" rel="#L1386">1386</span>
<span id="L1387" rel="#L1387">1387</span>
<span id="L1388" rel="#L1388">1388</span>
<span id="L1389" rel="#L1389">1389</span>
<span id="L1390" rel="#L1390">1390</span>
<span id="L1391" rel="#L1391">1391</span>
<span id="L1392" rel="#L1392">1392</span>
<span id="L1393" rel="#L1393">1393</span>
<span id="L1394" rel="#L1394">1394</span>
<span id="L1395" rel="#L1395">1395</span>
<span id="L1396" rel="#L1396">1396</span>
<span id="L1397" rel="#L1397">1397</span>
<span id="L1398" rel="#L1398">1398</span>
<span id="L1399" rel="#L1399">1399</span>
<span id="L1400" rel="#L1400">1400</span>
<span id="L1401" rel="#L1401">1401</span>
<span id="L1402" rel="#L1402">1402</span>
<span id="L1403" rel="#L1403">1403</span>
<span id="L1404" rel="#L1404">1404</span>
<span id="L1405" rel="#L1405">1405</span>
<span id="L1406" rel="#L1406">1406</span>
<span id="L1407" rel="#L1407">1407</span>
<span id="L1408" rel="#L1408">1408</span>
<span id="L1409" rel="#L1409">1409</span>
<span id="L1410" rel="#L1410">1410</span>
<span id="L1411" rel="#L1411">1411</span>
<span id="L1412" rel="#L1412">1412</span>
<span id="L1413" rel="#L1413">1413</span>
<span id="L1414" rel="#L1414">1414</span>
<span id="L1415" rel="#L1415">1415</span>
<span id="L1416" rel="#L1416">1416</span>
<span id="L1417" rel="#L1417">1417</span>
<span id="L1418" rel="#L1418">1418</span>
<span id="L1419" rel="#L1419">1419</span>
<span id="L1420" rel="#L1420">1420</span>
<span id="L1421" rel="#L1421">1421</span>
<span id="L1422" rel="#L1422">1422</span>
<span id="L1423" rel="#L1423">1423</span>
<span id="L1424" rel="#L1424">1424</span>
<span id="L1425" rel="#L1425">1425</span>
<span id="L1426" rel="#L1426">1426</span>
<span id="L1427" rel="#L1427">1427</span>
<span id="L1428" rel="#L1428">1428</span>
<span id="L1429" rel="#L1429">1429</span>
<span id="L1430" rel="#L1430">1430</span>
<span id="L1431" rel="#L1431">1431</span>
<span id="L1432" rel="#L1432">1432</span>
<span id="L1433" rel="#L1433">1433</span>
<span id="L1434" rel="#L1434">1434</span>
<span id="L1435" rel="#L1435">1435</span>
<span id="L1436" rel="#L1436">1436</span>
</pre>
          </td>
          <td width="100%">
                  <div class="highlight"><pre><div class='line' id='LC1'><span class="cm">/*!</span></div><div class='line' id='LC2'><span class="cm"> * jScrollPane - v2.0.0beta12 - 2012-09-27</span></div><div class='line' id='LC3'><span class="cm"> * http://jscrollpane.kelvinluck.com/</span></div><div class='line' id='LC4'><span class="cm"> *</span></div><div class='line' id='LC5'><span class="cm"> * Copyright (c) 2010 Kelvin Luck</span></div><div class='line' id='LC6'><span class="cm"> * Dual licensed under the MIT or GPL licenses.</span></div><div class='line' id='LC7'><span class="cm"> */</span></div><div class='line' id='LC8'><br/></div><div class='line' id='LC9'><span class="c1">// Script: jScrollPane - cross browser customisable scrollbars</span></div><div class='line' id='LC10'><span class="c1">//</span></div><div class='line' id='LC11'><span class="c1">// *Version: 2.0.0beta12, Last updated: 2012-09-27*</span></div><div class='line' id='LC12'><span class="c1">//</span></div><div class='line' id='LC13'><span class="c1">// Project Home - http://jscrollpane.kelvinluck.com/</span></div><div class='line' id='LC14'><span class="c1">// GitHub       - http://github.com/vitch/jScrollPane</span></div><div class='line' id='LC15'><span class="c1">// Source       - http://github.com/vitch/jScrollPane/raw/master/script/jquery.jscrollpane.js</span></div><div class='line' id='LC16'><span class="c1">// (Minified)   - http://github.com/vitch/jScrollPane/raw/master/script/jquery.jscrollpane.min.js</span></div><div class='line' id='LC17'><span class="c1">//</span></div><div class='line' id='LC18'><span class="c1">// About: License</span></div><div class='line' id='LC19'><span class="c1">//</span></div><div class='line' id='LC20'><span class="c1">// Copyright (c) 2012 Kelvin Luck</span></div><div class='line' id='LC21'><span class="c1">// Dual licensed under the MIT or GPL Version 2 licenses.</span></div><div class='line' id='LC22'><span class="c1">// http://jscrollpane.kelvinluck.com/MIT-LICENSE.txt</span></div><div class='line' id='LC23'><span class="c1">// http://jscrollpane.kelvinluck.com/GPL-LICENSE.txt</span></div><div class='line' id='LC24'><span class="c1">//</span></div><div class='line' id='LC25'><span class="c1">// About: Examples</span></div><div class='line' id='LC26'><span class="c1">//</span></div><div class='line' id='LC27'><span class="c1">// All examples and demos are available through the jScrollPane example site at:</span></div><div class='line' id='LC28'><span class="c1">// http://jscrollpane.kelvinluck.com/</span></div><div class='line' id='LC29'><span class="c1">//</span></div><div class='line' id='LC30'><span class="c1">// About: Support and Testing</span></div><div class='line' id='LC31'><span class="c1">//</span></div><div class='line' id='LC32'><span class="c1">// This plugin is tested on the browsers below and has been found to work reliably on them. If you run</span></div><div class='line' id='LC33'><span class="c1">// into a problem on one of the supported browsers then please visit the support section on the jScrollPane</span></div><div class='line' id='LC34'><span class="c1">// website (http://jscrollpane.kelvinluck.com/) for more information on getting support. You are also</span></div><div class='line' id='LC35'><span class="c1">// welcome to fork the project on GitHub if you can contribute a fix for a given issue. </span></div><div class='line' id='LC36'><span class="c1">//</span></div><div class='line' id='LC37'><span class="c1">// jQuery Versions - tested in 1.4.2+ - reported to work in 1.3.x</span></div><div class='line' id='LC38'><span class="c1">// Browsers Tested - Firefox 3.6.8, Safari 5, Opera 10.6, Chrome 5.0, IE 6, 7, 8</span></div><div class='line' id='LC39'><span class="c1">//</span></div><div class='line' id='LC40'><span class="c1">// About: Release History</span></div><div class='line' id='LC41'><span class="c1">//</span></div><div class='line' id='LC42'><span class="c1">// 2.0.0beta12 - (2012-09-27) fix for jQuery 1.8+</span></div><div class='line' id='LC43'><span class="c1">// 2.0.0beta11 - (2012-05-14)</span></div><div class='line' id='LC44'><span class="c1">// 2.0.0beta10 - (2011-04-17) cleaner required size calculation, improved keyboard support, stickToBottom/Left, other small fixes</span></div><div class='line' id='LC45'><span class="c1">// 2.0.0beta9 - (2011-01-31) new API methods, bug fixes and correct keyboard support for FF/OSX</span></div><div class='line' id='LC46'><span class="c1">// 2.0.0beta8 - (2011-01-29) touchscreen support, improved keyboard support</span></div><div class='line' id='LC47'><span class="c1">// 2.0.0beta7 - (2011-01-23) scroll speed consistent (thanks Aivo Paas)</span></div><div class='line' id='LC48'><span class="c1">// 2.0.0beta6 - (2010-12-07) scrollToElement horizontal support</span></div><div class='line' id='LC49'><span class="c1">// 2.0.0beta5 - (2010-10-18) jQuery 1.4.3 support, various bug fixes</span></div><div class='line' id='LC50'><span class="c1">// 2.0.0beta4 - (2010-09-17) clickOnTrack support, bug fixes</span></div><div class='line' id='LC51'><span class="c1">// 2.0.0beta3 - (2010-08-27) Horizontal mousewheel, mwheelIntent, keyboard support, bug fixes</span></div><div class='line' id='LC52'><span class="c1">// 2.0.0beta2 - (2010-08-21) Bug fixes</span></div><div class='line' id='LC53'><span class="c1">// 2.0.0beta1 - (2010-08-17) Rewrite to follow modern best practices and enable horizontal scrolling, initially hidden</span></div><div class='line' id='LC54'><span class="c1">//							 elements and dynamically sized elements.</span></div><div class='line' id='LC55'><span class="c1">// 1.x - (2006-12-31 - 2010-07-31) Initial version, hosted at googlecode, deprecated</span></div><div class='line' id='LC56'><br/></div><div class='line' id='LC57'><span class="p">(</span><span class="kd">function</span><span class="p">(</span><span class="nx">$</span><span class="p">,</span><span class="nb">window</span><span class="p">,</span><span class="kc">undefined</span><span class="p">){</span></div><div class='line' id='LC58'><br/></div><div class='line' id='LC59'>	<span class="nx">$</span><span class="p">.</span><span class="nx">fn</span><span class="p">.</span><span class="nx">jScrollPane</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">settings</span><span class="p">)</span></div><div class='line' id='LC60'>	<span class="p">{</span></div><div class='line' id='LC61'>		<span class="c1">// JScrollPane &quot;class&quot; - public methods are available through $(&#39;selector&#39;).data(&#39;jsp&#39;)</span></div><div class='line' id='LC62'>		<span class="kd">function</span> <span class="nx">JScrollPane</span><span class="p">(</span><span class="nx">elem</span><span class="p">,</span> <span class="nx">s</span><span class="p">)</span></div><div class='line' id='LC63'>		<span class="p">{</span></div><div class='line' id='LC64'>			<span class="kd">var</span> <span class="nx">settings</span><span class="p">,</span> <span class="nx">jsp</span> <span class="o">=</span> <span class="k">this</span><span class="p">,</span> <span class="nx">pane</span><span class="p">,</span> <span class="nx">paneWidth</span><span class="p">,</span> <span class="nx">paneHeight</span><span class="p">,</span> <span class="nx">container</span><span class="p">,</span> <span class="nx">contentWidth</span><span class="p">,</span> <span class="nx">contentHeight</span><span class="p">,</span></div><div class='line' id='LC65'>				<span class="nx">percentInViewH</span><span class="p">,</span> <span class="nx">percentInViewV</span><span class="p">,</span> <span class="nx">isScrollableV</span><span class="p">,</span> <span class="nx">isScrollableH</span><span class="p">,</span> <span class="nx">verticalDrag</span><span class="p">,</span> <span class="nx">dragMaxY</span><span class="p">,</span></div><div class='line' id='LC66'>				<span class="nx">verticalDragPosition</span><span class="p">,</span> <span class="nx">horizontalDrag</span><span class="p">,</span> <span class="nx">dragMaxX</span><span class="p">,</span> <span class="nx">horizontalDragPosition</span><span class="p">,</span></div><div class='line' id='LC67'>				<span class="nx">verticalBar</span><span class="p">,</span> <span class="nx">verticalTrack</span><span class="p">,</span> <span class="nx">scrollbarWidth</span><span class="p">,</span> <span class="nx">verticalTrackHeight</span><span class="p">,</span> <span class="nx">verticalDragHeight</span><span class="p">,</span> <span class="nx">arrowUp</span><span class="p">,</span> <span class="nx">arrowDown</span><span class="p">,</span></div><div class='line' id='LC68'>				<span class="nx">horizontalBar</span><span class="p">,</span> <span class="nx">horizontalTrack</span><span class="p">,</span> <span class="nx">horizontalTrackWidth</span><span class="p">,</span> <span class="nx">horizontalDragWidth</span><span class="p">,</span> <span class="nx">arrowLeft</span><span class="p">,</span> <span class="nx">arrowRight</span><span class="p">,</span></div><div class='line' id='LC69'>				<span class="nx">reinitialiseInterval</span><span class="p">,</span> <span class="nx">originalPadding</span><span class="p">,</span> <span class="nx">originalPaddingTotalWidth</span><span class="p">,</span> <span class="nx">previousContentWidth</span><span class="p">,</span></div><div class='line' id='LC70'>				<span class="nx">wasAtTop</span> <span class="o">=</span> <span class="kc">true</span><span class="p">,</span> <span class="nx">wasAtLeft</span> <span class="o">=</span> <span class="kc">true</span><span class="p">,</span> <span class="nx">wasAtBottom</span> <span class="o">=</span> <span class="kc">false</span><span class="p">,</span> <span class="nx">wasAtRight</span> <span class="o">=</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC71'>				<span class="nx">originalElement</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">clone</span><span class="p">(</span><span class="kc">false</span><span class="p">,</span> <span class="kc">false</span><span class="p">).</span><span class="nx">empty</span><span class="p">(),</span></div><div class='line' id='LC72'>				<span class="nx">mwEvent</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">fn</span><span class="p">.</span><span class="nx">mwheelIntent</span> <span class="o">?</span> <span class="s1">&#39;mwheelIntent.jsp&#39;</span> <span class="o">:</span> <span class="s1">&#39;mousewheel.jsp&#39;</span><span class="p">;</span></div><div class='line' id='LC73'><br/></div><div class='line' id='LC74'>			<span class="nx">originalPadding</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;paddingTop&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39; &#39;</span> <span class="o">+</span></div><div class='line' id='LC75'>								<span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;paddingRight&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39; &#39;</span> <span class="o">+</span></div><div class='line' id='LC76'>								<span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;paddingBottom&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39; &#39;</span> <span class="o">+</span></div><div class='line' id='LC77'>								<span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;paddingLeft&#39;</span><span class="p">);</span></div><div class='line' id='LC78'>			<span class="nx">originalPaddingTotalWidth</span> <span class="o">=</span> <span class="p">(</span><span class="nb">parseInt</span><span class="p">(</span><span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;paddingLeft&#39;</span><span class="p">),</span> <span class="mi">10</span><span class="p">)</span> <span class="o">||</span> <span class="mi">0</span><span class="p">)</span> <span class="o">+</span></div><div class='line' id='LC79'>										<span class="p">(</span><span class="nb">parseInt</span><span class="p">(</span><span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;paddingRight&#39;</span><span class="p">),</span> <span class="mi">10</span><span class="p">)</span> <span class="o">||</span> <span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC80'><br/></div><div class='line' id='LC81'>			<span class="kd">function</span> <span class="nx">initialise</span><span class="p">(</span><span class="nx">s</span><span class="p">)</span></div><div class='line' id='LC82'>			<span class="p">{</span></div><div class='line' id='LC83'><br/></div><div class='line' id='LC84'>				<span class="kd">var</span> <span class="cm">/*firstChild, lastChild, */</span><span class="nx">isMaintainingPositon</span><span class="p">,</span> <span class="nx">lastContentX</span><span class="p">,</span> <span class="nx">lastContentY</span><span class="p">,</span></div><div class='line' id='LC85'>						<span class="nx">hasContainingSpaceChanged</span><span class="p">,</span> <span class="nx">originalScrollTop</span><span class="p">,</span> <span class="nx">originalScrollLeft</span><span class="p">,</span></div><div class='line' id='LC86'>						<span class="nx">maintainAtBottom</span> <span class="o">=</span> <span class="kc">false</span><span class="p">,</span> <span class="nx">maintainAtRight</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC87'><br/></div><div class='line' id='LC88'>				<span class="nx">settings</span> <span class="o">=</span> <span class="nx">s</span><span class="p">;</span></div><div class='line' id='LC89'><br/></div><div class='line' id='LC90'>				<span class="k">if</span> <span class="p">(</span><span class="nx">pane</span> <span class="o">===</span> <span class="kc">undefined</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC91'>					<span class="nx">originalScrollTop</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">scrollTop</span><span class="p">();</span></div><div class='line' id='LC92'>					<span class="nx">originalScrollLeft</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">scrollLeft</span><span class="p">();</span></div><div class='line' id='LC93'><br/></div><div class='line' id='LC94'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span></div><div class='line' id='LC95'>						<span class="p">{</span></div><div class='line' id='LC96'>							<span class="nx">overflow</span><span class="o">:</span> <span class="s1">&#39;hidden&#39;</span><span class="p">,</span></div><div class='line' id='LC97'>							<span class="nx">padding</span><span class="o">:</span> <span class="mi">0</span></div><div class='line' id='LC98'>						<span class="p">}</span></div><div class='line' id='LC99'>					<span class="p">);</span></div><div class='line' id='LC100'>					<span class="c1">// TODO: Deal with where width/ height is 0 as it probably means the element is hidden and we should</span></div><div class='line' id='LC101'>					<span class="c1">// come back to it later and check once it is unhidden...</span></div><div class='line' id='LC102'>					<span class="nx">paneWidth</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">innerWidth</span><span class="p">()</span> <span class="o">+</span> <span class="nx">originalPaddingTotalWidth</span><span class="p">;</span></div><div class='line' id='LC103'>					<span class="nx">paneHeight</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">innerHeight</span><span class="p">();</span></div><div class='line' id='LC104'><br/></div><div class='line' id='LC105'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">width</span><span class="p">(</span><span class="nx">paneWidth</span><span class="p">);</span></div><div class='line' id='LC106'><br/></div><div class='line' id='LC107'>					<span class="nx">pane</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspPane&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;padding&#39;</span><span class="p">,</span> <span class="nx">originalPadding</span><span class="p">).</span><span class="nx">append</span><span class="p">(</span><span class="nx">elem</span><span class="p">.</span><span class="nx">children</span><span class="p">());</span></div><div class='line' id='LC108'>					<span class="nx">container</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspContainer&quot; /&gt;&#39;</span><span class="p">)</span></div><div class='line' id='LC109'>						<span class="p">.</span><span class="nx">css</span><span class="p">({</span></div><div class='line' id='LC110'>							<span class="s1">&#39;width&#39;</span><span class="o">:</span> <span class="nx">paneWidth</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">,</span></div><div class='line' id='LC111'>							<span class="s1">&#39;height&#39;</span><span class="o">:</span> <span class="nx">paneHeight</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span></div><div class='line' id='LC112'>						<span class="p">}</span></div><div class='line' id='LC113'>					<span class="p">).</span><span class="nx">append</span><span class="p">(</span><span class="nx">pane</span><span class="p">).</span><span class="nx">appendTo</span><span class="p">(</span><span class="nx">elem</span><span class="p">);</span></div><div class='line' id='LC114'><br/></div><div class='line' id='LC115'>					<span class="cm">/*</span></div><div class='line' id='LC116'><span class="cm">					// Move any margins from the first and last children up to the container so they can still</span></div><div class='line' id='LC117'><span class="cm">					// collapse with neighbouring elements as they would before jScrollPane </span></div><div class='line' id='LC118'><span class="cm">					firstChild = pane.find(&#39;:first-child&#39;);</span></div><div class='line' id='LC119'><span class="cm">					lastChild = pane.find(&#39;:last-child&#39;);</span></div><div class='line' id='LC120'><span class="cm">					elem.css(</span></div><div class='line' id='LC121'><span class="cm">						{</span></div><div class='line' id='LC122'><span class="cm">							&#39;margin-top&#39;: firstChild.css(&#39;margin-top&#39;),</span></div><div class='line' id='LC123'><span class="cm">							&#39;margin-bottom&#39;: lastChild.css(&#39;margin-bottom&#39;)</span></div><div class='line' id='LC124'><span class="cm">						}</span></div><div class='line' id='LC125'><span class="cm">					);</span></div><div class='line' id='LC126'><span class="cm">					firstChild.css(&#39;margin-top&#39;, 0);</span></div><div class='line' id='LC127'><span class="cm">					lastChild.css(&#39;margin-bottom&#39;, 0);</span></div><div class='line' id='LC128'><span class="cm">					*/</span></div><div class='line' id='LC129'>				<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC130'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;width&#39;</span><span class="p">,</span> <span class="s1">&#39;&#39;</span><span class="p">);</span></div><div class='line' id='LC131'><br/></div><div class='line' id='LC132'>					<span class="nx">maintainAtBottom</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">stickToBottom</span> <span class="o">&amp;&amp;</span> <span class="nx">isCloseToBottom</span><span class="p">();</span></div><div class='line' id='LC133'>					<span class="nx">maintainAtRight</span>  <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">stickToRight</span>  <span class="o">&amp;&amp;</span> <span class="nx">isCloseToRight</span><span class="p">();</span></div><div class='line' id='LC134'><br/></div><div class='line' id='LC135'>					<span class="nx">hasContainingSpaceChanged</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">innerWidth</span><span class="p">()</span> <span class="o">+</span> <span class="nx">originalPaddingTotalWidth</span> <span class="o">!=</span> <span class="nx">paneWidth</span> <span class="o">||</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">outerHeight</span><span class="p">()</span> <span class="o">!=</span> <span class="nx">paneHeight</span><span class="p">;</span></div><div class='line' id='LC136'><br/></div><div class='line' id='LC137'>					<span class="k">if</span> <span class="p">(</span><span class="nx">hasContainingSpaceChanged</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC138'>						<span class="nx">paneWidth</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">innerWidth</span><span class="p">()</span> <span class="o">+</span> <span class="nx">originalPaddingTotalWidth</span><span class="p">;</span></div><div class='line' id='LC139'>						<span class="nx">paneHeight</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">innerHeight</span><span class="p">();</span></div><div class='line' id='LC140'>						<span class="nx">container</span><span class="p">.</span><span class="nx">css</span><span class="p">({</span></div><div class='line' id='LC141'>							<span class="nx">width</span><span class="o">:</span> <span class="nx">paneWidth</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">,</span></div><div class='line' id='LC142'>							<span class="nx">height</span><span class="o">:</span> <span class="nx">paneHeight</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span></div><div class='line' id='LC143'>						<span class="p">});</span></div><div class='line' id='LC144'>					<span class="p">}</span></div><div class='line' id='LC145'><br/></div><div class='line' id='LC146'>					<span class="c1">// If nothing changed since last check...</span></div><div class='line' id='LC147'>					<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nx">hasContainingSpaceChanged</span> <span class="o">&amp;&amp;</span> <span class="nx">previousContentWidth</span> <span class="o">==</span> <span class="nx">contentWidth</span> <span class="o">&amp;&amp;</span> <span class="nx">pane</span><span class="p">.</span><span class="nx">outerHeight</span><span class="p">()</span> <span class="o">==</span> <span class="nx">contentHeight</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC148'>						<span class="nx">elem</span><span class="p">.</span><span class="nx">width</span><span class="p">(</span><span class="nx">paneWidth</span><span class="p">);</span></div><div class='line' id='LC149'>						<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC150'>					<span class="p">}</span></div><div class='line' id='LC151'>					<span class="nx">previousContentWidth</span> <span class="o">=</span> <span class="nx">contentWidth</span><span class="p">;</span></div><div class='line' id='LC152'><br/></div><div class='line' id='LC153'>					<span class="nx">pane</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;width&#39;</span><span class="p">,</span> <span class="s1">&#39;&#39;</span><span class="p">);</span></div><div class='line' id='LC154'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">width</span><span class="p">(</span><span class="nx">paneWidth</span><span class="p">);</span></div><div class='line' id='LC155'><br/></div><div class='line' id='LC156'>					<span class="nx">container</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspVerticalBar,&gt;.jspHorizontalBar&#39;</span><span class="p">).</span><span class="nx">remove</span><span class="p">().</span><span class="nx">end</span><span class="p">();</span></div><div class='line' id='LC157'>				<span class="p">}</span></div><div class='line' id='LC158'><br/></div><div class='line' id='LC159'>				<span class="nx">pane</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;overflow&#39;</span><span class="p">,</span> <span class="s1">&#39;auto&#39;</span><span class="p">);</span></div><div class='line' id='LC160'>				<span class="k">if</span> <span class="p">(</span><span class="nx">s</span><span class="p">.</span><span class="nx">contentWidth</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC161'>					<span class="nx">contentWidth</span> <span class="o">=</span> <span class="nx">s</span><span class="p">.</span><span class="nx">contentWidth</span><span class="p">;</span></div><div class='line' id='LC162'>				<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC163'>					<span class="nx">contentWidth</span> <span class="o">=</span> <span class="nx">pane</span><span class="p">[</span><span class="mi">0</span><span class="p">].</span><span class="nx">scrollWidth</span><span class="p">;</span></div><div class='line' id='LC164'>				<span class="p">}</span></div><div class='line' id='LC165'>				<span class="nx">contentHeight</span> <span class="o">=</span> <span class="nx">pane</span><span class="p">[</span><span class="mi">0</span><span class="p">].</span><span class="nx">scrollHeight</span><span class="p">;</span></div><div class='line' id='LC166'>				<span class="nx">pane</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;overflow&#39;</span><span class="p">,</span> <span class="s1">&#39;&#39;</span><span class="p">);</span></div><div class='line' id='LC167'><br/></div><div class='line' id='LC168'>				<span class="nx">percentInViewH</span> <span class="o">=</span> <span class="nx">contentWidth</span> <span class="o">/</span> <span class="nx">paneWidth</span><span class="p">;</span></div><div class='line' id='LC169'>				<span class="nx">percentInViewV</span> <span class="o">=</span> <span class="nx">contentHeight</span> <span class="o">/</span> <span class="nx">paneHeight</span><span class="p">;</span></div><div class='line' id='LC170'>				<span class="nx">isScrollableV</span> <span class="o">=</span> <span class="nx">percentInViewV</span> <span class="o">&gt;</span> <span class="mi">1</span><span class="p">;</span></div><div class='line' id='LC171'><br/></div><div class='line' id='LC172'>				<span class="nx">isScrollableH</span> <span class="o">=</span> <span class="nx">percentInViewH</span> <span class="o">&gt;</span> <span class="mi">1</span><span class="p">;</span></div><div class='line' id='LC173'><br/></div><div class='line' id='LC174'>				<span class="c1">//console.log(paneWidth, paneHeight, contentWidth, contentHeight, percentInViewH, percentInViewV, isScrollableH, isScrollableV);</span></div><div class='line' id='LC175'><br/></div><div class='line' id='LC176'>				<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="p">(</span><span class="nx">isScrollableH</span> <span class="o">||</span> <span class="nx">isScrollableV</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC177'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">removeClass</span><span class="p">(</span><span class="s1">&#39;jspScrollable&#39;</span><span class="p">);</span></div><div class='line' id='LC178'>					<span class="nx">pane</span><span class="p">.</span><span class="nx">css</span><span class="p">({</span></div><div class='line' id='LC179'>						<span class="nx">top</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC180'>						<span class="nx">width</span><span class="o">:</span> <span class="nx">container</span><span class="p">.</span><span class="nx">width</span><span class="p">()</span> <span class="o">-</span> <span class="nx">originalPaddingTotalWidth</span></div><div class='line' id='LC181'>					<span class="p">});</span></div><div class='line' id='LC182'>					<span class="nx">removeMousewheel</span><span class="p">();</span></div><div class='line' id='LC183'>					<span class="nx">removeFocusHandler</span><span class="p">();</span></div><div class='line' id='LC184'>					<span class="nx">removeKeyboardNav</span><span class="p">();</span></div><div class='line' id='LC185'>					<span class="nx">removeClickOnTrack</span><span class="p">();</span></div><div class='line' id='LC186'>				<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC187'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">addClass</span><span class="p">(</span><span class="s1">&#39;jspScrollable&#39;</span><span class="p">);</span></div><div class='line' id='LC188'><br/></div><div class='line' id='LC189'>					<span class="nx">isMaintainingPositon</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">maintainPosition</span> <span class="o">&amp;&amp;</span> <span class="p">(</span><span class="nx">verticalDragPosition</span> <span class="o">||</span> <span class="nx">horizontalDragPosition</span><span class="p">);</span></div><div class='line' id='LC190'>					<span class="k">if</span> <span class="p">(</span><span class="nx">isMaintainingPositon</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC191'>						<span class="nx">lastContentX</span> <span class="o">=</span> <span class="nx">contentPositionX</span><span class="p">();</span></div><div class='line' id='LC192'>						<span class="nx">lastContentY</span> <span class="o">=</span> <span class="nx">contentPositionY</span><span class="p">();</span></div><div class='line' id='LC193'>					<span class="p">}</span></div><div class='line' id='LC194'><br/></div><div class='line' id='LC195'>					<span class="nx">initialiseVerticalScroll</span><span class="p">();</span></div><div class='line' id='LC196'>					<span class="nx">initialiseHorizontalScroll</span><span class="p">();</span></div><div class='line' id='LC197'>					<span class="nx">resizeScrollbars</span><span class="p">();</span></div><div class='line' id='LC198'><br/></div><div class='line' id='LC199'>					<span class="k">if</span> <span class="p">(</span><span class="nx">isMaintainingPositon</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC200'>						<span class="nx">scrollToX</span><span class="p">(</span><span class="nx">maintainAtRight</span>  <span class="o">?</span> <span class="p">(</span><span class="nx">contentWidth</span>  <span class="o">-</span> <span class="nx">paneWidth</span> <span class="p">)</span> <span class="o">:</span> <span class="nx">lastContentX</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC201'>						<span class="nx">scrollToY</span><span class="p">(</span><span class="nx">maintainAtBottom</span> <span class="o">?</span> <span class="p">(</span><span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">)</span> <span class="o">:</span> <span class="nx">lastContentY</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC202'>					<span class="p">}</span></div><div class='line' id='LC203'><br/></div><div class='line' id='LC204'>					<span class="nx">initFocusHandler</span><span class="p">();</span></div><div class='line' id='LC205'>					<span class="nx">initMousewheel</span><span class="p">();</span></div><div class='line' id='LC206'>					<span class="nx">initTouch</span><span class="p">();</span></div><div class='line' id='LC207'><br/></div><div class='line' id='LC208'>					<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">enableKeyboardNavigation</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC209'>						<span class="nx">initKeyboardNav</span><span class="p">();</span></div><div class='line' id='LC210'>					<span class="p">}</span></div><div class='line' id='LC211'>					<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">clickOnTrack</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC212'>						<span class="nx">initClickOnTrack</span><span class="p">();</span></div><div class='line' id='LC213'>					<span class="p">}</span></div><div class='line' id='LC214'><br/></div><div class='line' id='LC215'>					<span class="nx">observeHash</span><span class="p">();</span></div><div class='line' id='LC216'>					<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">hijackInternalLinks</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC217'>						<span class="nx">hijackInternalLinks</span><span class="p">();</span></div><div class='line' id='LC218'>					<span class="p">}</span></div><div class='line' id='LC219'>				<span class="p">}</span></div><div class='line' id='LC220'><br/></div><div class='line' id='LC221'>				<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">autoReinitialise</span> <span class="o">&amp;&amp;</span> <span class="o">!</span><span class="nx">reinitialiseInterval</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC222'>					<span class="nx">reinitialiseInterval</span> <span class="o">=</span> <span class="nx">setInterval</span><span class="p">(</span></div><div class='line' id='LC223'>						<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC224'>						<span class="p">{</span></div><div class='line' id='LC225'>							<span class="nx">initialise</span><span class="p">(</span><span class="nx">settings</span><span class="p">);</span></div><div class='line' id='LC226'>						<span class="p">},</span></div><div class='line' id='LC227'>						<span class="nx">settings</span><span class="p">.</span><span class="nx">autoReinitialiseDelay</span></div><div class='line' id='LC228'>					<span class="p">);</span></div><div class='line' id='LC229'>				<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nx">settings</span><span class="p">.</span><span class="nx">autoReinitialise</span> <span class="o">&amp;&amp;</span> <span class="nx">reinitialiseInterval</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC230'>					<span class="nx">clearInterval</span><span class="p">(</span><span class="nx">reinitialiseInterval</span><span class="p">);</span></div><div class='line' id='LC231'>				<span class="p">}</span></div><div class='line' id='LC232'><br/></div><div class='line' id='LC233'>				<span class="nx">originalScrollTop</span> <span class="o">&amp;&amp;</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">scrollTop</span><span class="p">(</span><span class="mi">0</span><span class="p">)</span> <span class="o">&amp;&amp;</span> <span class="nx">scrollToY</span><span class="p">(</span><span class="nx">originalScrollTop</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC234'>				<span class="nx">originalScrollLeft</span> <span class="o">&amp;&amp;</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">scrollLeft</span><span class="p">(</span><span class="mi">0</span><span class="p">)</span> <span class="o">&amp;&amp;</span> <span class="nx">scrollToX</span><span class="p">(</span><span class="nx">originalScrollLeft</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC235'><br/></div><div class='line' id='LC236'>				<span class="nx">elem</span><span class="p">.</span><span class="nx">trigger</span><span class="p">(</span><span class="s1">&#39;jsp-initialised&#39;</span><span class="p">,</span> <span class="p">[</span><span class="nx">isScrollableH</span> <span class="o">||</span> <span class="nx">isScrollableV</span><span class="p">]);</span></div><div class='line' id='LC237'>			<span class="p">}</span></div><div class='line' id='LC238'><br/></div><div class='line' id='LC239'>			<span class="kd">function</span> <span class="nx">initialiseVerticalScroll</span><span class="p">()</span></div><div class='line' id='LC240'>			<span class="p">{</span></div><div class='line' id='LC241'>				<span class="k">if</span> <span class="p">(</span><span class="nx">isScrollableV</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC242'><br/></div><div class='line' id='LC243'>					<span class="nx">container</span><span class="p">.</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC244'>						<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspVerticalBar&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC245'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspCap jspCapTop&quot; /&gt;&#39;</span><span class="p">),</span></div><div class='line' id='LC246'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspTrack&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC247'>								<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspDrag&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC248'>									<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspDragTop&quot; /&gt;&#39;</span><span class="p">),</span></div><div class='line' id='LC249'>									<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspDragBottom&quot; /&gt;&#39;</span><span class="p">)</span></div><div class='line' id='LC250'>								<span class="p">)</span></div><div class='line' id='LC251'>							<span class="p">),</span></div><div class='line' id='LC252'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspCap jspCapBottom&quot; /&gt;&#39;</span><span class="p">)</span></div><div class='line' id='LC253'>						<span class="p">)</span></div><div class='line' id='LC254'>					<span class="p">);</span></div><div class='line' id='LC255'><br/></div><div class='line' id='LC256'>					<span class="nx">verticalBar</span> <span class="o">=</span> <span class="nx">container</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspVerticalBar&#39;</span><span class="p">);</span></div><div class='line' id='LC257'>					<span class="nx">verticalTrack</span> <span class="o">=</span> <span class="nx">verticalBar</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspTrack&#39;</span><span class="p">);</span></div><div class='line' id='LC258'>					<span class="nx">verticalDrag</span> <span class="o">=</span> <span class="nx">verticalTrack</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspDrag&#39;</span><span class="p">);</span></div><div class='line' id='LC259'><br/></div><div class='line' id='LC260'>					<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">showArrows</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC261'>						<span class="nx">arrowUp</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;a class=&quot;jspArrow jspArrowUp&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC262'>							<span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">,</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="mi">0</span><span class="p">,</span> <span class="o">-</span><span class="mi">1</span><span class="p">)</span></div><div class='line' id='LC263'>						<span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;click.jsp&#39;</span><span class="p">,</span> <span class="nx">nil</span><span class="p">);</span></div><div class='line' id='LC264'>						<span class="nx">arrowDown</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;a class=&quot;jspArrow jspArrowDown&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC265'>							<span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">,</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="mi">0</span><span class="p">,</span> <span class="mi">1</span><span class="p">)</span></div><div class='line' id='LC266'>						<span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;click.jsp&#39;</span><span class="p">,</span> <span class="nx">nil</span><span class="p">);</span></div><div class='line' id='LC267'>						<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">arrowScrollOnHover</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC268'>							<span class="nx">arrowUp</span><span class="p">.</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;mouseover.jsp&#39;</span><span class="p">,</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="mi">0</span><span class="p">,</span> <span class="o">-</span><span class="mi">1</span><span class="p">,</span> <span class="nx">arrowUp</span><span class="p">));</span></div><div class='line' id='LC269'>							<span class="nx">arrowDown</span><span class="p">.</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;mouseover.jsp&#39;</span><span class="p">,</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="mi">0</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="nx">arrowDown</span><span class="p">));</span></div><div class='line' id='LC270'>						<span class="p">}</span></div><div class='line' id='LC271'><br/></div><div class='line' id='LC272'>						<span class="nx">appendArrows</span><span class="p">(</span><span class="nx">verticalTrack</span><span class="p">,</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">verticalArrowPositions</span><span class="p">,</span> <span class="nx">arrowUp</span><span class="p">,</span> <span class="nx">arrowDown</span><span class="p">);</span></div><div class='line' id='LC273'>					<span class="p">}</span></div><div class='line' id='LC274'><br/></div><div class='line' id='LC275'>					<span class="nx">verticalTrackHeight</span> <span class="o">=</span> <span class="nx">paneHeight</span><span class="p">;</span></div><div class='line' id='LC276'>					<span class="nx">container</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspVerticalBar&gt;.jspCap:visible,&gt;.jspVerticalBar&gt;.jspArrow&#39;</span><span class="p">).</span><span class="nx">each</span><span class="p">(</span></div><div class='line' id='LC277'>						<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC278'>						<span class="p">{</span></div><div class='line' id='LC279'>							<span class="nx">verticalTrackHeight</span> <span class="o">-=</span> <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">).</span><span class="nx">outerHeight</span><span class="p">();</span></div><div class='line' id='LC280'>						<span class="p">}</span></div><div class='line' id='LC281'>					<span class="p">);</span></div><div class='line' id='LC282'><br/></div><div class='line' id='LC283'><br/></div><div class='line' id='LC284'>					<span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">hover</span><span class="p">(</span></div><div class='line' id='LC285'>						<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC286'>						<span class="p">{</span></div><div class='line' id='LC287'>							<span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">addClass</span><span class="p">(</span><span class="s1">&#39;jspHover&#39;</span><span class="p">);</span></div><div class='line' id='LC288'>						<span class="p">},</span></div><div class='line' id='LC289'>						<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC290'>						<span class="p">{</span></div><div class='line' id='LC291'>							<span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">removeClass</span><span class="p">(</span><span class="s1">&#39;jspHover&#39;</span><span class="p">);</span></div><div class='line' id='LC292'>						<span class="p">}</span></div><div class='line' id='LC293'>					<span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC294'>						<span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC295'>						<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC296'>						<span class="p">{</span></div><div class='line' id='LC297'>							<span class="c1">// Stop IE from allowing text selection</span></div><div class='line' id='LC298'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;html&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;dragstart.jsp selectstart.jsp&#39;</span><span class="p">,</span> <span class="nx">nil</span><span class="p">);</span></div><div class='line' id='LC299'><br/></div><div class='line' id='LC300'>							<span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">addClass</span><span class="p">(</span><span class="s1">&#39;jspActive&#39;</span><span class="p">);</span></div><div class='line' id='LC301'><br/></div><div class='line' id='LC302'>							<span class="kd">var</span> <span class="nx">startY</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">pageY</span> <span class="o">-</span> <span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">top</span><span class="p">;</span></div><div class='line' id='LC303'><br/></div><div class='line' id='LC304'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;html&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC305'>								<span class="s1">&#39;mousemove.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC306'>								<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC307'>								<span class="p">{</span></div><div class='line' id='LC308'>									<span class="nx">positionDragY</span><span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">pageY</span> <span class="o">-</span> <span class="nx">startY</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC309'>								<span class="p">}</span></div><div class='line' id='LC310'>							<span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;mouseup.jsp mouseleave.jsp&#39;</span><span class="p">,</span> <span class="nx">cancelDrag</span><span class="p">);</span></div><div class='line' id='LC311'>							<span class="k">return</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC312'>						<span class="p">}</span></div><div class='line' id='LC313'>					<span class="p">);</span></div><div class='line' id='LC314'>					<span class="nx">sizeVerticalScrollbar</span><span class="p">();</span></div><div class='line' id='LC315'>				<span class="p">}</span></div><div class='line' id='LC316'>			<span class="p">}</span></div><div class='line' id='LC317'><br/></div><div class='line' id='LC318'>			<span class="kd">function</span> <span class="nx">sizeVerticalScrollbar</span><span class="p">()</span></div><div class='line' id='LC319'>			<span class="p">{</span></div><div class='line' id='LC320'>				<span class="nx">verticalTrack</span><span class="p">.</span><span class="nx">height</span><span class="p">(</span><span class="nx">verticalTrackHeight</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">);</span></div><div class='line' id='LC321'>				<span class="nx">verticalDragPosition</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC322'>				<span class="nx">scrollbarWidth</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">verticalGutter</span> <span class="o">+</span> <span class="nx">verticalTrack</span><span class="p">.</span><span class="nx">outerWidth</span><span class="p">();</span></div><div class='line' id='LC323'><br/></div><div class='line' id='LC324'>				<span class="c1">// Make the pane thinner to allow for the vertical scrollbar</span></div><div class='line' id='LC325'>				<span class="nx">pane</span><span class="p">.</span><span class="nx">width</span><span class="p">(</span><span class="nx">paneWidth</span> <span class="o">-</span> <span class="nx">scrollbarWidth</span> <span class="o">-</span> <span class="nx">originalPaddingTotalWidth</span><span class="p">);</span></div><div class='line' id='LC326'><br/></div><div class='line' id='LC327'>				<span class="c1">// Add margin to the left of the pane if scrollbars are on that side (to position</span></div><div class='line' id='LC328'>				<span class="c1">// the scrollbar on the left or right set it&#39;s left or right property in CSS)</span></div><div class='line' id='LC329'>				<span class="k">try</span> <span class="p">{</span></div><div class='line' id='LC330'>					<span class="k">if</span> <span class="p">(</span><span class="nx">verticalBar</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">left</span> <span class="o">===</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC331'>						<span class="nx">pane</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;margin-left&#39;</span><span class="p">,</span> <span class="nx">scrollbarWidth</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">);</span></div><div class='line' id='LC332'>					<span class="p">}</span></div><div class='line' id='LC333'>				<span class="p">}</span> <span class="k">catch</span> <span class="p">(</span><span class="nx">err</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC334'>				<span class="p">}</span></div><div class='line' id='LC335'>			<span class="p">}</span></div><div class='line' id='LC336'><br/></div><div class='line' id='LC337'>			<span class="kd">function</span> <span class="nx">initialiseHorizontalScroll</span><span class="p">()</span></div><div class='line' id='LC338'>			<span class="p">{</span></div><div class='line' id='LC339'>				<span class="k">if</span> <span class="p">(</span><span class="nx">isScrollableH</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC340'><br/></div><div class='line' id='LC341'>					<span class="nx">container</span><span class="p">.</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC342'>						<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspHorizontalBar&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC343'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspCap jspCapLeft&quot; /&gt;&#39;</span><span class="p">),</span></div><div class='line' id='LC344'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspTrack&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC345'>								<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspDrag&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC346'>									<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspDragLeft&quot; /&gt;&#39;</span><span class="p">),</span></div><div class='line' id='LC347'>									<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspDragRight&quot; /&gt;&#39;</span><span class="p">)</span></div><div class='line' id='LC348'>								<span class="p">)</span></div><div class='line' id='LC349'>							<span class="p">),</span></div><div class='line' id='LC350'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspCap jspCapRight&quot; /&gt;&#39;</span><span class="p">)</span></div><div class='line' id='LC351'>						<span class="p">)</span></div><div class='line' id='LC352'>					<span class="p">);</span></div><div class='line' id='LC353'><br/></div><div class='line' id='LC354'>					<span class="nx">horizontalBar</span> <span class="o">=</span> <span class="nx">container</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspHorizontalBar&#39;</span><span class="p">);</span></div><div class='line' id='LC355'>					<span class="nx">horizontalTrack</span> <span class="o">=</span> <span class="nx">horizontalBar</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspTrack&#39;</span><span class="p">);</span></div><div class='line' id='LC356'>					<span class="nx">horizontalDrag</span> <span class="o">=</span> <span class="nx">horizontalTrack</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspDrag&#39;</span><span class="p">);</span></div><div class='line' id='LC357'><br/></div><div class='line' id='LC358'>					<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">showArrows</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC359'>						<span class="nx">arrowLeft</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;a class=&quot;jspArrow jspArrowLeft&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC360'>							<span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">,</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="o">-</span><span class="mi">1</span><span class="p">,</span> <span class="mi">0</span><span class="p">)</span></div><div class='line' id='LC361'>						<span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;click.jsp&#39;</span><span class="p">,</span> <span class="nx">nil</span><span class="p">);</span></div><div class='line' id='LC362'>						<span class="nx">arrowRight</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;a class=&quot;jspArrow jspArrowRight&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC363'>							<span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">,</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="mi">0</span><span class="p">)</span></div><div class='line' id='LC364'>						<span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;click.jsp&#39;</span><span class="p">,</span> <span class="nx">nil</span><span class="p">);</span></div><div class='line' id='LC365'>						<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">arrowScrollOnHover</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC366'>							<span class="nx">arrowLeft</span><span class="p">.</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;mouseover.jsp&#39;</span><span class="p">,</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="o">-</span><span class="mi">1</span><span class="p">,</span> <span class="mi">0</span><span class="p">,</span> <span class="nx">arrowLeft</span><span class="p">));</span></div><div class='line' id='LC367'>							<span class="nx">arrowRight</span><span class="p">.</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;mouseover.jsp&#39;</span><span class="p">,</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="mi">0</span><span class="p">,</span> <span class="nx">arrowRight</span><span class="p">));</span></div><div class='line' id='LC368'>						<span class="p">}</span></div><div class='line' id='LC369'>						<span class="nx">appendArrows</span><span class="p">(</span><span class="nx">horizontalTrack</span><span class="p">,</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">horizontalArrowPositions</span><span class="p">,</span> <span class="nx">arrowLeft</span><span class="p">,</span> <span class="nx">arrowRight</span><span class="p">);</span></div><div class='line' id='LC370'>					<span class="p">}</span></div><div class='line' id='LC371'><br/></div><div class='line' id='LC372'>					<span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">hover</span><span class="p">(</span></div><div class='line' id='LC373'>						<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC374'>						<span class="p">{</span></div><div class='line' id='LC375'>							<span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">addClass</span><span class="p">(</span><span class="s1">&#39;jspHover&#39;</span><span class="p">);</span></div><div class='line' id='LC376'>						<span class="p">},</span></div><div class='line' id='LC377'>						<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC378'>						<span class="p">{</span></div><div class='line' id='LC379'>							<span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">removeClass</span><span class="p">(</span><span class="s1">&#39;jspHover&#39;</span><span class="p">);</span></div><div class='line' id='LC380'>						<span class="p">}</span></div><div class='line' id='LC381'>					<span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC382'>						<span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC383'>						<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC384'>						<span class="p">{</span></div><div class='line' id='LC385'>							<span class="c1">// Stop IE from allowing text selection</span></div><div class='line' id='LC386'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;html&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;dragstart.jsp selectstart.jsp&#39;</span><span class="p">,</span> <span class="nx">nil</span><span class="p">);</span></div><div class='line' id='LC387'><br/></div><div class='line' id='LC388'>							<span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">addClass</span><span class="p">(</span><span class="s1">&#39;jspActive&#39;</span><span class="p">);</span></div><div class='line' id='LC389'><br/></div><div class='line' id='LC390'>							<span class="kd">var</span> <span class="nx">startX</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">pageX</span> <span class="o">-</span> <span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">left</span><span class="p">;</span></div><div class='line' id='LC391'><br/></div><div class='line' id='LC392'>							<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;html&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC393'>								<span class="s1">&#39;mousemove.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC394'>								<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC395'>								<span class="p">{</span></div><div class='line' id='LC396'>									<span class="nx">positionDragX</span><span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">pageX</span> <span class="o">-</span> <span class="nx">startX</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC397'>								<span class="p">}</span></div><div class='line' id='LC398'>							<span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;mouseup.jsp mouseleave.jsp&#39;</span><span class="p">,</span> <span class="nx">cancelDrag</span><span class="p">);</span></div><div class='line' id='LC399'>							<span class="k">return</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC400'>						<span class="p">}</span></div><div class='line' id='LC401'>					<span class="p">);</span></div><div class='line' id='LC402'>					<span class="nx">horizontalTrackWidth</span> <span class="o">=</span> <span class="nx">container</span><span class="p">.</span><span class="nx">innerWidth</span><span class="p">();</span></div><div class='line' id='LC403'>					<span class="nx">sizeHorizontalScrollbar</span><span class="p">();</span></div><div class='line' id='LC404'>				<span class="p">}</span></div><div class='line' id='LC405'>			<span class="p">}</span></div><div class='line' id='LC406'><br/></div><div class='line' id='LC407'>			<span class="kd">function</span> <span class="nx">sizeHorizontalScrollbar</span><span class="p">()</span></div><div class='line' id='LC408'>			<span class="p">{</span></div><div class='line' id='LC409'>				<span class="nx">container</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspHorizontalBar&gt;.jspCap:visible,&gt;.jspHorizontalBar&gt;.jspArrow&#39;</span><span class="p">).</span><span class="nx">each</span><span class="p">(</span></div><div class='line' id='LC410'>					<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC411'>					<span class="p">{</span></div><div class='line' id='LC412'>						<span class="nx">horizontalTrackWidth</span> <span class="o">-=</span> <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">).</span><span class="nx">outerWidth</span><span class="p">();</span></div><div class='line' id='LC413'>					<span class="p">}</span></div><div class='line' id='LC414'>				<span class="p">);</span></div><div class='line' id='LC415'><br/></div><div class='line' id='LC416'>				<span class="nx">horizontalTrack</span><span class="p">.</span><span class="nx">width</span><span class="p">(</span><span class="nx">horizontalTrackWidth</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">);</span></div><div class='line' id='LC417'>				<span class="nx">horizontalDragPosition</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC418'>			<span class="p">}</span></div><div class='line' id='LC419'><br/></div><div class='line' id='LC420'>			<span class="kd">function</span> <span class="nx">resizeScrollbars</span><span class="p">()</span></div><div class='line' id='LC421'>			<span class="p">{</span></div><div class='line' id='LC422'>				<span class="k">if</span> <span class="p">(</span><span class="nx">isScrollableH</span> <span class="o">&amp;&amp;</span> <span class="nx">isScrollableV</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC423'>					<span class="kd">var</span> <span class="nx">horizontalTrackHeight</span> <span class="o">=</span> <span class="nx">horizontalTrack</span><span class="p">.</span><span class="nx">outerHeight</span><span class="p">(),</span></div><div class='line' id='LC424'>						<span class="nx">verticalTrackWidth</span> <span class="o">=</span> <span class="nx">verticalTrack</span><span class="p">.</span><span class="nx">outerWidth</span><span class="p">();</span></div><div class='line' id='LC425'>					<span class="nx">verticalTrackHeight</span> <span class="o">-=</span> <span class="nx">horizontalTrackHeight</span><span class="p">;</span></div><div class='line' id='LC426'>					<span class="nx">$</span><span class="p">(</span><span class="nx">horizontalBar</span><span class="p">).</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;&gt;.jspCap:visible,&gt;.jspArrow&#39;</span><span class="p">).</span><span class="nx">each</span><span class="p">(</span></div><div class='line' id='LC427'>						<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC428'>						<span class="p">{</span></div><div class='line' id='LC429'>							<span class="nx">horizontalTrackWidth</span> <span class="o">+=</span> <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">).</span><span class="nx">outerWidth</span><span class="p">();</span></div><div class='line' id='LC430'>						<span class="p">}</span></div><div class='line' id='LC431'>					<span class="p">);</span></div><div class='line' id='LC432'>					<span class="nx">horizontalTrackWidth</span> <span class="o">-=</span> <span class="nx">verticalTrackWidth</span><span class="p">;</span></div><div class='line' id='LC433'>					<span class="nx">paneHeight</span> <span class="o">-=</span> <span class="nx">verticalTrackWidth</span><span class="p">;</span></div><div class='line' id='LC434'>					<span class="nx">paneWidth</span> <span class="o">-=</span> <span class="nx">horizontalTrackHeight</span><span class="p">;</span></div><div class='line' id='LC435'>					<span class="nx">horizontalTrack</span><span class="p">.</span><span class="nx">parent</span><span class="p">().</span><span class="nx">append</span><span class="p">(</span></div><div class='line' id='LC436'>						<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div class=&quot;jspCorner&quot; /&gt;&#39;</span><span class="p">).</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;width&#39;</span><span class="p">,</span> <span class="nx">horizontalTrackHeight</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">)</span></div><div class='line' id='LC437'>					<span class="p">);</span></div><div class='line' id='LC438'>					<span class="nx">sizeVerticalScrollbar</span><span class="p">();</span></div><div class='line' id='LC439'>					<span class="nx">sizeHorizontalScrollbar</span><span class="p">();</span></div><div class='line' id='LC440'>				<span class="p">}</span></div><div class='line' id='LC441'>				<span class="c1">// reflow content</span></div><div class='line' id='LC442'>				<span class="k">if</span> <span class="p">(</span><span class="nx">isScrollableH</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC443'>					<span class="nx">pane</span><span class="p">.</span><span class="nx">width</span><span class="p">((</span><span class="nx">container</span><span class="p">.</span><span class="nx">outerWidth</span><span class="p">()</span> <span class="o">-</span> <span class="nx">originalPaddingTotalWidth</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">);</span></div><div class='line' id='LC444'>				<span class="p">}</span></div><div class='line' id='LC445'>				<span class="nx">contentHeight</span> <span class="o">=</span> <span class="nx">pane</span><span class="p">.</span><span class="nx">outerHeight</span><span class="p">();</span></div><div class='line' id='LC446'>				<span class="nx">percentInViewV</span> <span class="o">=</span> <span class="nx">contentHeight</span> <span class="o">/</span> <span class="nx">paneHeight</span><span class="p">;</span></div><div class='line' id='LC447'><br/></div><div class='line' id='LC448'>				<span class="k">if</span> <span class="p">(</span><span class="nx">isScrollableH</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC449'>					<span class="nx">horizontalDragWidth</span> <span class="o">=</span> <span class="nb">Math</span><span class="p">.</span><span class="nx">ceil</span><span class="p">(</span><span class="mi">1</span> <span class="o">/</span> <span class="nx">percentInViewH</span> <span class="o">*</span> <span class="nx">horizontalTrackWidth</span><span class="p">);</span></div><div class='line' id='LC450'>					<span class="k">if</span> <span class="p">(</span><span class="nx">horizontalDragWidth</span> <span class="o">&gt;</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">horizontalDragMaxWidth</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC451'>						<span class="nx">horizontalDragWidth</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">horizontalDragMaxWidth</span><span class="p">;</span></div><div class='line' id='LC452'>					<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">horizontalDragWidth</span> <span class="o">&lt;</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">horizontalDragMinWidth</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC453'>						<span class="nx">horizontalDragWidth</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">horizontalDragMinWidth</span><span class="p">;</span></div><div class='line' id='LC454'>					<span class="p">}</span></div><div class='line' id='LC455'>					<span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">width</span><span class="p">(</span><span class="nx">horizontalDragWidth</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">);</span></div><div class='line' id='LC456'>					<span class="nx">dragMaxX</span> <span class="o">=</span> <span class="nx">horizontalTrackWidth</span> <span class="o">-</span> <span class="nx">horizontalDragWidth</span><span class="p">;</span></div><div class='line' id='LC457'>					<span class="nx">_positionDragX</span><span class="p">(</span><span class="nx">horizontalDragPosition</span><span class="p">);</span> <span class="c1">// To update the state for the arrow buttons</span></div><div class='line' id='LC458'>				<span class="p">}</span></div><div class='line' id='LC459'>				<span class="k">if</span> <span class="p">(</span><span class="nx">isScrollableV</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC460'>					<span class="nx">verticalDragHeight</span> <span class="o">=</span> <span class="nb">Math</span><span class="p">.</span><span class="nx">ceil</span><span class="p">(</span><span class="mi">1</span> <span class="o">/</span> <span class="nx">percentInViewV</span> <span class="o">*</span> <span class="nx">verticalTrackHeight</span><span class="p">);</span></div><div class='line' id='LC461'>					<span class="k">if</span> <span class="p">(</span><span class="nx">verticalDragHeight</span> <span class="o">&gt;</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">verticalDragMaxHeight</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC462'>						<span class="nx">verticalDragHeight</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">verticalDragMaxHeight</span><span class="p">;</span></div><div class='line' id='LC463'>					<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">verticalDragHeight</span> <span class="o">&lt;</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">verticalDragMinHeight</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC464'>						<span class="nx">verticalDragHeight</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">verticalDragMinHeight</span><span class="p">;</span></div><div class='line' id='LC465'>					<span class="p">}</span></div><div class='line' id='LC466'>					<span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">height</span><span class="p">(</span><span class="nx">verticalDragHeight</span> <span class="o">+</span> <span class="s1">&#39;px&#39;</span><span class="p">);</span></div><div class='line' id='LC467'>					<span class="nx">dragMaxY</span> <span class="o">=</span> <span class="nx">verticalTrackHeight</span> <span class="o">-</span> <span class="nx">verticalDragHeight</span><span class="p">;</span></div><div class='line' id='LC468'>					<span class="nx">_positionDragY</span><span class="p">(</span><span class="nx">verticalDragPosition</span><span class="p">);</span> <span class="c1">// To update the state for the arrow buttons</span></div><div class='line' id='LC469'>				<span class="p">}</span></div><div class='line' id='LC470'>			<span class="p">}</span></div><div class='line' id='LC471'><br/></div><div class='line' id='LC472'>			<span class="kd">function</span> <span class="nx">appendArrows</span><span class="p">(</span><span class="nx">ele</span><span class="p">,</span> <span class="nx">p</span><span class="p">,</span> <span class="nx">a1</span><span class="p">,</span> <span class="nx">a2</span><span class="p">)</span></div><div class='line' id='LC473'>			<span class="p">{</span></div><div class='line' id='LC474'>				<span class="kd">var</span> <span class="nx">p1</span> <span class="o">=</span> <span class="s2">&quot;before&quot;</span><span class="p">,</span> <span class="nx">p2</span> <span class="o">=</span> <span class="s2">&quot;after&quot;</span><span class="p">,</span> <span class="nx">aTemp</span><span class="p">;</span></div><div class='line' id='LC475'><br/></div><div class='line' id='LC476'>				<span class="c1">// Sniff for mac... Is there a better way to determine whether the arrows would naturally appear</span></div><div class='line' id='LC477'>				<span class="c1">// at the top or the bottom of the bar?</span></div><div class='line' id='LC478'>				<span class="k">if</span> <span class="p">(</span><span class="nx">p</span> <span class="o">==</span> <span class="s2">&quot;os&quot;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC479'>					<span class="nx">p</span> <span class="o">=</span> <span class="sr">/Mac/</span><span class="p">.</span><span class="nx">test</span><span class="p">(</span><span class="nx">navigator</span><span class="p">.</span><span class="nx">platform</span><span class="p">)</span> <span class="o">?</span> <span class="s2">&quot;after&quot;</span> <span class="o">:</span> <span class="s2">&quot;split&quot;</span><span class="p">;</span></div><div class='line' id='LC480'>				<span class="p">}</span></div><div class='line' id='LC481'>				<span class="k">if</span> <span class="p">(</span><span class="nx">p</span> <span class="o">==</span> <span class="nx">p1</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC482'>					<span class="nx">p2</span> <span class="o">=</span> <span class="nx">p</span><span class="p">;</span></div><div class='line' id='LC483'>				<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">p</span> <span class="o">==</span> <span class="nx">p2</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC484'>					<span class="nx">p1</span> <span class="o">=</span> <span class="nx">p</span><span class="p">;</span></div><div class='line' id='LC485'>					<span class="nx">aTemp</span> <span class="o">=</span> <span class="nx">a1</span><span class="p">;</span></div><div class='line' id='LC486'>					<span class="nx">a1</span> <span class="o">=</span> <span class="nx">a2</span><span class="p">;</span></div><div class='line' id='LC487'>					<span class="nx">a2</span> <span class="o">=</span> <span class="nx">aTemp</span><span class="p">;</span></div><div class='line' id='LC488'>				<span class="p">}</span></div><div class='line' id='LC489'><br/></div><div class='line' id='LC490'>				<span class="nx">ele</span><span class="p">[</span><span class="nx">p1</span><span class="p">](</span><span class="nx">a1</span><span class="p">)[</span><span class="nx">p2</span><span class="p">](</span><span class="nx">a2</span><span class="p">);</span></div><div class='line' id='LC491'>			<span class="p">}</span></div><div class='line' id='LC492'><br/></div><div class='line' id='LC493'>			<span class="kd">function</span> <span class="nx">getArrowScroll</span><span class="p">(</span><span class="nx">dirX</span><span class="p">,</span> <span class="nx">dirY</span><span class="p">,</span> <span class="nx">ele</span><span class="p">)</span></div><div class='line' id='LC494'>			<span class="p">{</span></div><div class='line' id='LC495'>				<span class="k">return</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC496'>				<span class="p">{</span></div><div class='line' id='LC497'>					<span class="nx">arrowScroll</span><span class="p">(</span><span class="nx">dirX</span><span class="p">,</span> <span class="nx">dirY</span><span class="p">,</span> <span class="k">this</span><span class="p">,</span> <span class="nx">ele</span><span class="p">);</span></div><div class='line' id='LC498'>					<span class="k">this</span><span class="p">.</span><span class="nx">blur</span><span class="p">();</span></div><div class='line' id='LC499'>					<span class="k">return</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC500'>				<span class="p">};</span></div><div class='line' id='LC501'>			<span class="p">}</span></div><div class='line' id='LC502'><br/></div><div class='line' id='LC503'>			<span class="kd">function</span> <span class="nx">arrowScroll</span><span class="p">(</span><span class="nx">dirX</span><span class="p">,</span> <span class="nx">dirY</span><span class="p">,</span> <span class="nx">arrow</span><span class="p">,</span> <span class="nx">ele</span><span class="p">)</span></div><div class='line' id='LC504'>			<span class="p">{</span></div><div class='line' id='LC505'>				<span class="nx">arrow</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="nx">arrow</span><span class="p">).</span><span class="nx">addClass</span><span class="p">(</span><span class="s1">&#39;jspActive&#39;</span><span class="p">);</span></div><div class='line' id='LC506'><br/></div><div class='line' id='LC507'>				<span class="kd">var</span> <span class="nx">eve</span><span class="p">,</span></div><div class='line' id='LC508'>					<span class="nx">scrollTimeout</span><span class="p">,</span></div><div class='line' id='LC509'>					<span class="nx">isFirst</span> <span class="o">=</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC510'>					<span class="nx">doScroll</span> <span class="o">=</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC511'>					<span class="p">{</span></div><div class='line' id='LC512'>						<span class="k">if</span> <span class="p">(</span><span class="nx">dirX</span> <span class="o">!==</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC513'>							<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByX</span><span class="p">(</span><span class="nx">dirX</span> <span class="o">*</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">arrowButtonSpeed</span><span class="p">);</span></div><div class='line' id='LC514'>						<span class="p">}</span></div><div class='line' id='LC515'>						<span class="k">if</span> <span class="p">(</span><span class="nx">dirY</span> <span class="o">!==</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC516'>							<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByY</span><span class="p">(</span><span class="nx">dirY</span> <span class="o">*</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">arrowButtonSpeed</span><span class="p">);</span></div><div class='line' id='LC517'>						<span class="p">}</span></div><div class='line' id='LC518'>						<span class="nx">scrollTimeout</span> <span class="o">=</span> <span class="nx">setTimeout</span><span class="p">(</span><span class="nx">doScroll</span><span class="p">,</span> <span class="nx">isFirst</span> <span class="o">?</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">initialDelay</span> <span class="o">:</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">arrowRepeatFreq</span><span class="p">);</span></div><div class='line' id='LC519'>						<span class="nx">isFirst</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC520'>					<span class="p">};</span></div><div class='line' id='LC521'><br/></div><div class='line' id='LC522'>				<span class="nx">doScroll</span><span class="p">();</span></div><div class='line' id='LC523'><br/></div><div class='line' id='LC524'>				<span class="nx">eve</span> <span class="o">=</span> <span class="nx">ele</span> <span class="o">?</span> <span class="s1">&#39;mouseout.jsp&#39;</span> <span class="o">:</span> <span class="s1">&#39;mouseup.jsp&#39;</span><span class="p">;</span></div><div class='line' id='LC525'>				<span class="nx">ele</span> <span class="o">=</span> <span class="nx">ele</span> <span class="o">||</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;html&#39;</span><span class="p">);</span></div><div class='line' id='LC526'>				<span class="nx">ele</span><span class="p">.</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC527'>					<span class="nx">eve</span><span class="p">,</span></div><div class='line' id='LC528'>					<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC529'>					<span class="p">{</span></div><div class='line' id='LC530'>						<span class="nx">arrow</span><span class="p">.</span><span class="nx">removeClass</span><span class="p">(</span><span class="s1">&#39;jspActive&#39;</span><span class="p">);</span></div><div class='line' id='LC531'>						<span class="nx">scrollTimeout</span> <span class="o">&amp;&amp;</span> <span class="nx">clearTimeout</span><span class="p">(</span><span class="nx">scrollTimeout</span><span class="p">);</span></div><div class='line' id='LC532'>						<span class="nx">scrollTimeout</span> <span class="o">=</span> <span class="kc">null</span><span class="p">;</span></div><div class='line' id='LC533'>						<span class="nx">ele</span><span class="p">.</span><span class="nx">unbind</span><span class="p">(</span><span class="nx">eve</span><span class="p">);</span></div><div class='line' id='LC534'>					<span class="p">}</span></div><div class='line' id='LC535'>				<span class="p">);</span></div><div class='line' id='LC536'>			<span class="p">}</span></div><div class='line' id='LC537'><br/></div><div class='line' id='LC538'>			<span class="kd">function</span> <span class="nx">initClickOnTrack</span><span class="p">()</span></div><div class='line' id='LC539'>			<span class="p">{</span></div><div class='line' id='LC540'>				<span class="nx">removeClickOnTrack</span><span class="p">();</span></div><div class='line' id='LC541'>				<span class="k">if</span> <span class="p">(</span><span class="nx">isScrollableV</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC542'>					<span class="nx">verticalTrack</span><span class="p">.</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC543'>						<span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC544'>						<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC545'>						<span class="p">{</span></div><div class='line' id='LC546'>							<span class="k">if</span> <span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">originalTarget</span> <span class="o">===</span> <span class="kc">undefined</span> <span class="o">||</span> <span class="nx">e</span><span class="p">.</span><span class="nx">originalTarget</span> <span class="o">==</span> <span class="nx">e</span><span class="p">.</span><span class="nx">currentTarget</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC547'>								<span class="kd">var</span> <span class="nx">clickedTrack</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">),</span></div><div class='line' id='LC548'>									<span class="nx">offset</span> <span class="o">=</span> <span class="nx">clickedTrack</span><span class="p">.</span><span class="nx">offset</span><span class="p">(),</span></div><div class='line' id='LC549'>									<span class="nx">direction</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">pageY</span> <span class="o">-</span> <span class="nx">offset</span><span class="p">.</span><span class="nx">top</span> <span class="o">-</span> <span class="nx">verticalDragPosition</span><span class="p">,</span></div><div class='line' id='LC550'>									<span class="nx">scrollTimeout</span><span class="p">,</span></div><div class='line' id='LC551'>									<span class="nx">isFirst</span> <span class="o">=</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC552'>									<span class="nx">doScroll</span> <span class="o">=</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC553'>									<span class="p">{</span></div><div class='line' id='LC554'>										<span class="kd">var</span> <span class="nx">offset</span> <span class="o">=</span> <span class="nx">clickedTrack</span><span class="p">.</span><span class="nx">offset</span><span class="p">(),</span></div><div class='line' id='LC555'>											<span class="nx">pos</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">pageY</span> <span class="o">-</span> <span class="nx">offset</span><span class="p">.</span><span class="nx">top</span> <span class="o">-</span> <span class="nx">verticalDragHeight</span> <span class="o">/</span> <span class="mi">2</span><span class="p">,</span></div><div class='line' id='LC556'>											<span class="nx">contentDragY</span> <span class="o">=</span> <span class="nx">paneHeight</span> <span class="o">*</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">scrollPagePercent</span><span class="p">,</span></div><div class='line' id='LC557'>											<span class="nx">dragY</span> <span class="o">=</span> <span class="nx">dragMaxY</span> <span class="o">*</span> <span class="nx">contentDragY</span> <span class="o">/</span> <span class="p">(</span><span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">);</span></div><div class='line' id='LC558'>										<span class="k">if</span> <span class="p">(</span><span class="nx">direction</span> <span class="o">&lt;</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC559'>											<span class="k">if</span> <span class="p">(</span><span class="nx">verticalDragPosition</span> <span class="o">-</span> <span class="nx">dragY</span> <span class="o">&gt;</span> <span class="nx">pos</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC560'>												<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByY</span><span class="p">(</span><span class="o">-</span><span class="nx">contentDragY</span><span class="p">);</span></div><div class='line' id='LC561'>											<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC562'>												<span class="nx">positionDragY</span><span class="p">(</span><span class="nx">pos</span><span class="p">);</span></div><div class='line' id='LC563'>											<span class="p">}</span></div><div class='line' id='LC564'>										<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">direction</span> <span class="o">&gt;</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC565'>											<span class="k">if</span> <span class="p">(</span><span class="nx">verticalDragPosition</span> <span class="o">+</span> <span class="nx">dragY</span> <span class="o">&lt;</span> <span class="nx">pos</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC566'>												<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByY</span><span class="p">(</span><span class="nx">contentDragY</span><span class="p">);</span></div><div class='line' id='LC567'>											<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC568'>												<span class="nx">positionDragY</span><span class="p">(</span><span class="nx">pos</span><span class="p">);</span></div><div class='line' id='LC569'>											<span class="p">}</span></div><div class='line' id='LC570'>										<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC571'>											<span class="nx">cancelClick</span><span class="p">();</span></div><div class='line' id='LC572'>											<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC573'>										<span class="p">}</span></div><div class='line' id='LC574'>										<span class="nx">scrollTimeout</span> <span class="o">=</span> <span class="nx">setTimeout</span><span class="p">(</span><span class="nx">doScroll</span><span class="p">,</span> <span class="nx">isFirst</span> <span class="o">?</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">initialDelay</span> <span class="o">:</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">trackClickRepeatFreq</span><span class="p">);</span></div><div class='line' id='LC575'>										<span class="nx">isFirst</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC576'>									<span class="p">},</span></div><div class='line' id='LC577'>									<span class="nx">cancelClick</span> <span class="o">=</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC578'>									<span class="p">{</span></div><div class='line' id='LC579'>										<span class="nx">scrollTimeout</span> <span class="o">&amp;&amp;</span> <span class="nx">clearTimeout</span><span class="p">(</span><span class="nx">scrollTimeout</span><span class="p">);</span></div><div class='line' id='LC580'>										<span class="nx">scrollTimeout</span> <span class="o">=</span> <span class="kc">null</span><span class="p">;</span></div><div class='line' id='LC581'>										<span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">).</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;mouseup.jsp&#39;</span><span class="p">,</span> <span class="nx">cancelClick</span><span class="p">);</span></div><div class='line' id='LC582'>									<span class="p">};</span></div><div class='line' id='LC583'>								<span class="nx">doScroll</span><span class="p">();</span></div><div class='line' id='LC584'>								<span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;mouseup.jsp&#39;</span><span class="p">,</span> <span class="nx">cancelClick</span><span class="p">);</span></div><div class='line' id='LC585'>								<span class="k">return</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC586'>							<span class="p">}</span></div><div class='line' id='LC587'>						<span class="p">}</span></div><div class='line' id='LC588'>					<span class="p">);</span></div><div class='line' id='LC589'>				<span class="p">}</span></div><div class='line' id='LC590'><br/></div><div class='line' id='LC591'>				<span class="k">if</span> <span class="p">(</span><span class="nx">isScrollableH</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC592'>					<span class="nx">horizontalTrack</span><span class="p">.</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC593'>						<span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC594'>						<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC595'>						<span class="p">{</span></div><div class='line' id='LC596'>							<span class="k">if</span> <span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">originalTarget</span> <span class="o">===</span> <span class="kc">undefined</span> <span class="o">||</span> <span class="nx">e</span><span class="p">.</span><span class="nx">originalTarget</span> <span class="o">==</span> <span class="nx">e</span><span class="p">.</span><span class="nx">currentTarget</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC597'>								<span class="kd">var</span> <span class="nx">clickedTrack</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">),</span></div><div class='line' id='LC598'>									<span class="nx">offset</span> <span class="o">=</span> <span class="nx">clickedTrack</span><span class="p">.</span><span class="nx">offset</span><span class="p">(),</span></div><div class='line' id='LC599'>									<span class="nx">direction</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">pageX</span> <span class="o">-</span> <span class="nx">offset</span><span class="p">.</span><span class="nx">left</span> <span class="o">-</span> <span class="nx">horizontalDragPosition</span><span class="p">,</span></div><div class='line' id='LC600'>									<span class="nx">scrollTimeout</span><span class="p">,</span></div><div class='line' id='LC601'>									<span class="nx">isFirst</span> <span class="o">=</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC602'>									<span class="nx">doScroll</span> <span class="o">=</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC603'>									<span class="p">{</span></div><div class='line' id='LC604'>										<span class="kd">var</span> <span class="nx">offset</span> <span class="o">=</span> <span class="nx">clickedTrack</span><span class="p">.</span><span class="nx">offset</span><span class="p">(),</span></div><div class='line' id='LC605'>											<span class="nx">pos</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">pageX</span> <span class="o">-</span> <span class="nx">offset</span><span class="p">.</span><span class="nx">left</span> <span class="o">-</span> <span class="nx">horizontalDragWidth</span> <span class="o">/</span> <span class="mi">2</span><span class="p">,</span></div><div class='line' id='LC606'>											<span class="nx">contentDragX</span> <span class="o">=</span> <span class="nx">paneWidth</span> <span class="o">*</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">scrollPagePercent</span><span class="p">,</span></div><div class='line' id='LC607'>											<span class="nx">dragX</span> <span class="o">=</span> <span class="nx">dragMaxX</span> <span class="o">*</span> <span class="nx">contentDragX</span> <span class="o">/</span> <span class="p">(</span><span class="nx">contentWidth</span> <span class="o">-</span> <span class="nx">paneWidth</span><span class="p">);</span></div><div class='line' id='LC608'>										<span class="k">if</span> <span class="p">(</span><span class="nx">direction</span> <span class="o">&lt;</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC609'>											<span class="k">if</span> <span class="p">(</span><span class="nx">horizontalDragPosition</span> <span class="o">-</span> <span class="nx">dragX</span> <span class="o">&gt;</span> <span class="nx">pos</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC610'>												<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByX</span><span class="p">(</span><span class="o">-</span><span class="nx">contentDragX</span><span class="p">);</span></div><div class='line' id='LC611'>											<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC612'>												<span class="nx">positionDragX</span><span class="p">(</span><span class="nx">pos</span><span class="p">);</span></div><div class='line' id='LC613'>											<span class="p">}</span></div><div class='line' id='LC614'>										<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">direction</span> <span class="o">&gt;</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC615'>											<span class="k">if</span> <span class="p">(</span><span class="nx">horizontalDragPosition</span> <span class="o">+</span> <span class="nx">dragX</span> <span class="o">&lt;</span> <span class="nx">pos</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC616'>												<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByX</span><span class="p">(</span><span class="nx">contentDragX</span><span class="p">);</span></div><div class='line' id='LC617'>											<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC618'>												<span class="nx">positionDragX</span><span class="p">(</span><span class="nx">pos</span><span class="p">);</span></div><div class='line' id='LC619'>											<span class="p">}</span></div><div class='line' id='LC620'>										<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC621'>											<span class="nx">cancelClick</span><span class="p">();</span></div><div class='line' id='LC622'>											<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC623'>										<span class="p">}</span></div><div class='line' id='LC624'>										<span class="nx">scrollTimeout</span> <span class="o">=</span> <span class="nx">setTimeout</span><span class="p">(</span><span class="nx">doScroll</span><span class="p">,</span> <span class="nx">isFirst</span> <span class="o">?</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">initialDelay</span> <span class="o">:</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">trackClickRepeatFreq</span><span class="p">);</span></div><div class='line' id='LC625'>										<span class="nx">isFirst</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC626'>									<span class="p">},</span></div><div class='line' id='LC627'>									<span class="nx">cancelClick</span> <span class="o">=</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC628'>									<span class="p">{</span></div><div class='line' id='LC629'>										<span class="nx">scrollTimeout</span> <span class="o">&amp;&amp;</span> <span class="nx">clearTimeout</span><span class="p">(</span><span class="nx">scrollTimeout</span><span class="p">);</span></div><div class='line' id='LC630'>										<span class="nx">scrollTimeout</span> <span class="o">=</span> <span class="kc">null</span><span class="p">;</span></div><div class='line' id='LC631'>										<span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">).</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;mouseup.jsp&#39;</span><span class="p">,</span> <span class="nx">cancelClick</span><span class="p">);</span></div><div class='line' id='LC632'>									<span class="p">};</span></div><div class='line' id='LC633'>								<span class="nx">doScroll</span><span class="p">();</span></div><div class='line' id='LC634'>								<span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span><span class="s1">&#39;mouseup.jsp&#39;</span><span class="p">,</span> <span class="nx">cancelClick</span><span class="p">);</span></div><div class='line' id='LC635'>								<span class="k">return</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC636'>							<span class="p">}</span></div><div class='line' id='LC637'>						<span class="p">}</span></div><div class='line' id='LC638'>					<span class="p">);</span></div><div class='line' id='LC639'>				<span class="p">}</span></div><div class='line' id='LC640'>			<span class="p">}</span></div><div class='line' id='LC641'><br/></div><div class='line' id='LC642'>			<span class="kd">function</span> <span class="nx">removeClickOnTrack</span><span class="p">()</span></div><div class='line' id='LC643'>			<span class="p">{</span></div><div class='line' id='LC644'>				<span class="k">if</span> <span class="p">(</span><span class="nx">horizontalTrack</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC645'>					<span class="nx">horizontalTrack</span><span class="p">.</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">);</span></div><div class='line' id='LC646'>				<span class="p">}</span></div><div class='line' id='LC647'>				<span class="k">if</span> <span class="p">(</span><span class="nx">verticalTrack</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC648'>					<span class="nx">verticalTrack</span><span class="p">.</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;mousedown.jsp&#39;</span><span class="p">);</span></div><div class='line' id='LC649'>				<span class="p">}</span></div><div class='line' id='LC650'>			<span class="p">}</span></div><div class='line' id='LC651'><br/></div><div class='line' id='LC652'>			<span class="kd">function</span> <span class="nx">cancelDrag</span><span class="p">()</span></div><div class='line' id='LC653'>			<span class="p">{</span></div><div class='line' id='LC654'>				<span class="nx">$</span><span class="p">(</span><span class="s1">&#39;html&#39;</span><span class="p">).</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp&#39;</span><span class="p">);</span></div><div class='line' id='LC655'><br/></div><div class='line' id='LC656'>				<span class="k">if</span> <span class="p">(</span><span class="nx">verticalDrag</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC657'>					<span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">removeClass</span><span class="p">(</span><span class="s1">&#39;jspActive&#39;</span><span class="p">);</span></div><div class='line' id='LC658'>				<span class="p">}</span></div><div class='line' id='LC659'>				<span class="k">if</span> <span class="p">(</span><span class="nx">horizontalDrag</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC660'>					<span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">removeClass</span><span class="p">(</span><span class="s1">&#39;jspActive&#39;</span><span class="p">);</span></div><div class='line' id='LC661'>				<span class="p">}</span></div><div class='line' id='LC662'>			<span class="p">}</span></div><div class='line' id='LC663'><br/></div><div class='line' id='LC664'>			<span class="kd">function</span> <span class="nx">positionDragY</span><span class="p">(</span><span class="nx">destY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC665'>			<span class="p">{</span></div><div class='line' id='LC666'>				<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nx">isScrollableV</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC667'>					<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC668'>				<span class="p">}</span></div><div class='line' id='LC669'>				<span class="k">if</span> <span class="p">(</span><span class="nx">destY</span> <span class="o">&lt;</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC670'>					<span class="nx">destY</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC671'>				<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">destY</span> <span class="o">&gt;</span> <span class="nx">dragMaxY</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC672'>					<span class="nx">destY</span> <span class="o">=</span> <span class="nx">dragMaxY</span><span class="p">;</span></div><div class='line' id='LC673'>				<span class="p">}</span></div><div class='line' id='LC674'><br/></div><div class='line' id='LC675'>				<span class="c1">// can&#39;t just check if(animate) because false is a valid value that could be passed in...</span></div><div class='line' id='LC676'>				<span class="k">if</span> <span class="p">(</span><span class="nx">animate</span> <span class="o">===</span> <span class="kc">undefined</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC677'>					<span class="nx">animate</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">animateScroll</span><span class="p">;</span></div><div class='line' id='LC678'>				<span class="p">}</span></div><div class='line' id='LC679'>				<span class="k">if</span> <span class="p">(</span><span class="nx">animate</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC680'>					<span class="nx">jsp</span><span class="p">.</span><span class="nx">animate</span><span class="p">(</span><span class="nx">verticalDrag</span><span class="p">,</span> <span class="s1">&#39;top&#39;</span><span class="p">,</span> <span class="nx">destY</span><span class="p">,</span>	<span class="nx">_positionDragY</span><span class="p">);</span></div><div class='line' id='LC681'>				<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC682'>					<span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;top&#39;</span><span class="p">,</span> <span class="nx">destY</span><span class="p">);</span></div><div class='line' id='LC683'>					<span class="nx">_positionDragY</span><span class="p">(</span><span class="nx">destY</span><span class="p">);</span></div><div class='line' id='LC684'>				<span class="p">}</span></div><div class='line' id='LC685'><br/></div><div class='line' id='LC686'>			<span class="p">}</span></div><div class='line' id='LC687'><br/></div><div class='line' id='LC688'>			<span class="kd">function</span> <span class="nx">_positionDragY</span><span class="p">(</span><span class="nx">destY</span><span class="p">)</span></div><div class='line' id='LC689'>			<span class="p">{</span></div><div class='line' id='LC690'>				<span class="k">if</span> <span class="p">(</span><span class="nx">destY</span> <span class="o">===</span> <span class="kc">undefined</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC691'>					<span class="nx">destY</span> <span class="o">=</span> <span class="nx">verticalDrag</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">top</span><span class="p">;</span></div><div class='line' id='LC692'>				<span class="p">}</span></div><div class='line' id='LC693'><br/></div><div class='line' id='LC694'>				<span class="nx">container</span><span class="p">.</span><span class="nx">scrollTop</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC695'>				<span class="nx">verticalDragPosition</span> <span class="o">=</span> <span class="nx">destY</span><span class="p">;</span></div><div class='line' id='LC696'><br/></div><div class='line' id='LC697'>				<span class="kd">var</span> <span class="nx">isAtTop</span> <span class="o">=</span> <span class="nx">verticalDragPosition</span> <span class="o">===</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC698'>					<span class="nx">isAtBottom</span> <span class="o">=</span> <span class="nx">verticalDragPosition</span> <span class="o">==</span> <span class="nx">dragMaxY</span><span class="p">,</span></div><div class='line' id='LC699'>					<span class="nx">percentScrolled</span> <span class="o">=</span> <span class="nx">destY</span><span class="o">/</span> <span class="nx">dragMaxY</span><span class="p">,</span></div><div class='line' id='LC700'>					<span class="nx">destTop</span> <span class="o">=</span> <span class="o">-</span><span class="nx">percentScrolled</span> <span class="o">*</span> <span class="p">(</span><span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">);</span></div><div class='line' id='LC701'><br/></div><div class='line' id='LC702'>				<span class="k">if</span> <span class="p">(</span><span class="nx">wasAtTop</span> <span class="o">!=</span> <span class="nx">isAtTop</span> <span class="o">||</span> <span class="nx">wasAtBottom</span> <span class="o">!=</span> <span class="nx">isAtBottom</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC703'>					<span class="nx">wasAtTop</span> <span class="o">=</span> <span class="nx">isAtTop</span><span class="p">;</span></div><div class='line' id='LC704'>					<span class="nx">wasAtBottom</span> <span class="o">=</span> <span class="nx">isAtBottom</span><span class="p">;</span></div><div class='line' id='LC705'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">trigger</span><span class="p">(</span><span class="s1">&#39;jsp-arrow-change&#39;</span><span class="p">,</span> <span class="p">[</span><span class="nx">wasAtTop</span><span class="p">,</span> <span class="nx">wasAtBottom</span><span class="p">,</span> <span class="nx">wasAtLeft</span><span class="p">,</span> <span class="nx">wasAtRight</span><span class="p">]);</span></div><div class='line' id='LC706'>				<span class="p">}</span></div><div class='line' id='LC707'><br/></div><div class='line' id='LC708'>				<span class="nx">updateVerticalArrows</span><span class="p">(</span><span class="nx">isAtTop</span><span class="p">,</span> <span class="nx">isAtBottom</span><span class="p">);</span></div><div class='line' id='LC709'>				<span class="nx">pane</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;top&#39;</span><span class="p">,</span> <span class="nx">destTop</span><span class="p">);</span></div><div class='line' id='LC710'>				<span class="nx">elem</span><span class="p">.</span><span class="nx">trigger</span><span class="p">(</span><span class="s1">&#39;jsp-scroll-y&#39;</span><span class="p">,</span> <span class="p">[</span><span class="o">-</span><span class="nx">destTop</span><span class="p">,</span> <span class="nx">isAtTop</span><span class="p">,</span> <span class="nx">isAtBottom</span><span class="p">]).</span><span class="nx">trigger</span><span class="p">(</span><span class="s1">&#39;scroll&#39;</span><span class="p">);</span></div><div class='line' id='LC711'>			<span class="p">}</span></div><div class='line' id='LC712'><br/></div><div class='line' id='LC713'>			<span class="kd">function</span> <span class="nx">positionDragX</span><span class="p">(</span><span class="nx">destX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC714'>			<span class="p">{</span></div><div class='line' id='LC715'>				<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nx">isScrollableH</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC716'>					<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC717'>				<span class="p">}</span></div><div class='line' id='LC718'>				<span class="k">if</span> <span class="p">(</span><span class="nx">destX</span> <span class="o">&lt;</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC719'>					<span class="nx">destX</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC720'>				<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">destX</span> <span class="o">&gt;</span> <span class="nx">dragMaxX</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC721'>					<span class="nx">destX</span> <span class="o">=</span> <span class="nx">dragMaxX</span><span class="p">;</span></div><div class='line' id='LC722'>				<span class="p">}</span></div><div class='line' id='LC723'><br/></div><div class='line' id='LC724'>				<span class="k">if</span> <span class="p">(</span><span class="nx">animate</span> <span class="o">===</span> <span class="kc">undefined</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC725'>					<span class="nx">animate</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">animateScroll</span><span class="p">;</span></div><div class='line' id='LC726'>				<span class="p">}</span></div><div class='line' id='LC727'>				<span class="k">if</span> <span class="p">(</span><span class="nx">animate</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC728'>					<span class="nx">jsp</span><span class="p">.</span><span class="nx">animate</span><span class="p">(</span><span class="nx">horizontalDrag</span><span class="p">,</span> <span class="s1">&#39;left&#39;</span><span class="p">,</span> <span class="nx">destX</span><span class="p">,</span>	<span class="nx">_positionDragX</span><span class="p">);</span></div><div class='line' id='LC729'>				<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC730'>					<span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;left&#39;</span><span class="p">,</span> <span class="nx">destX</span><span class="p">);</span></div><div class='line' id='LC731'>					<span class="nx">_positionDragX</span><span class="p">(</span><span class="nx">destX</span><span class="p">);</span></div><div class='line' id='LC732'>				<span class="p">}</span></div><div class='line' id='LC733'>			<span class="p">}</span></div><div class='line' id='LC734'><br/></div><div class='line' id='LC735'>			<span class="kd">function</span> <span class="nx">_positionDragX</span><span class="p">(</span><span class="nx">destX</span><span class="p">)</span></div><div class='line' id='LC736'>			<span class="p">{</span></div><div class='line' id='LC737'>				<span class="k">if</span> <span class="p">(</span><span class="nx">destX</span> <span class="o">===</span> <span class="kc">undefined</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC738'>					<span class="nx">destX</span> <span class="o">=</span> <span class="nx">horizontalDrag</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">left</span><span class="p">;</span></div><div class='line' id='LC739'>				<span class="p">}</span></div><div class='line' id='LC740'><br/></div><div class='line' id='LC741'>				<span class="nx">container</span><span class="p">.</span><span class="nx">scrollTop</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC742'>				<span class="nx">horizontalDragPosition</span> <span class="o">=</span> <span class="nx">destX</span><span class="p">;</span></div><div class='line' id='LC743'><br/></div><div class='line' id='LC744'>				<span class="kd">var</span> <span class="nx">isAtLeft</span> <span class="o">=</span> <span class="nx">horizontalDragPosition</span> <span class="o">===</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC745'>					<span class="nx">isAtRight</span> <span class="o">=</span> <span class="nx">horizontalDragPosition</span> <span class="o">==</span> <span class="nx">dragMaxX</span><span class="p">,</span></div><div class='line' id='LC746'>					<span class="nx">percentScrolled</span> <span class="o">=</span> <span class="nx">destX</span> <span class="o">/</span> <span class="nx">dragMaxX</span><span class="p">,</span></div><div class='line' id='LC747'>					<span class="nx">destLeft</span> <span class="o">=</span> <span class="o">-</span><span class="nx">percentScrolled</span> <span class="o">*</span> <span class="p">(</span><span class="nx">contentWidth</span> <span class="o">-</span> <span class="nx">paneWidth</span><span class="p">);</span></div><div class='line' id='LC748'><br/></div><div class='line' id='LC749'>				<span class="k">if</span> <span class="p">(</span><span class="nx">wasAtLeft</span> <span class="o">!=</span> <span class="nx">isAtLeft</span> <span class="o">||</span> <span class="nx">wasAtRight</span> <span class="o">!=</span> <span class="nx">isAtRight</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC750'>					<span class="nx">wasAtLeft</span> <span class="o">=</span> <span class="nx">isAtLeft</span><span class="p">;</span></div><div class='line' id='LC751'>					<span class="nx">wasAtRight</span> <span class="o">=</span> <span class="nx">isAtRight</span><span class="p">;</span></div><div class='line' id='LC752'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">trigger</span><span class="p">(</span><span class="s1">&#39;jsp-arrow-change&#39;</span><span class="p">,</span> <span class="p">[</span><span class="nx">wasAtTop</span><span class="p">,</span> <span class="nx">wasAtBottom</span><span class="p">,</span> <span class="nx">wasAtLeft</span><span class="p">,</span> <span class="nx">wasAtRight</span><span class="p">]);</span></div><div class='line' id='LC753'>				<span class="p">}</span></div><div class='line' id='LC754'><br/></div><div class='line' id='LC755'>				<span class="nx">updateHorizontalArrows</span><span class="p">(</span><span class="nx">isAtLeft</span><span class="p">,</span> <span class="nx">isAtRight</span><span class="p">);</span></div><div class='line' id='LC756'>				<span class="nx">pane</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;left&#39;</span><span class="p">,</span> <span class="nx">destLeft</span><span class="p">);</span></div><div class='line' id='LC757'>				<span class="nx">elem</span><span class="p">.</span><span class="nx">trigger</span><span class="p">(</span><span class="s1">&#39;jsp-scroll-x&#39;</span><span class="p">,</span> <span class="p">[</span><span class="o">-</span><span class="nx">destLeft</span><span class="p">,</span> <span class="nx">isAtLeft</span><span class="p">,</span> <span class="nx">isAtRight</span><span class="p">]).</span><span class="nx">trigger</span><span class="p">(</span><span class="s1">&#39;scroll&#39;</span><span class="p">);</span></div><div class='line' id='LC758'>			<span class="p">}</span></div><div class='line' id='LC759'><br/></div><div class='line' id='LC760'>			<span class="kd">function</span> <span class="nx">updateVerticalArrows</span><span class="p">(</span><span class="nx">isAtTop</span><span class="p">,</span> <span class="nx">isAtBottom</span><span class="p">)</span></div><div class='line' id='LC761'>			<span class="p">{</span></div><div class='line' id='LC762'>				<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">showArrows</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC763'>					<span class="nx">arrowUp</span><span class="p">[</span><span class="nx">isAtTop</span> <span class="o">?</span> <span class="s1">&#39;addClass&#39;</span> <span class="o">:</span> <span class="s1">&#39;removeClass&#39;</span><span class="p">](</span><span class="s1">&#39;jspDisabled&#39;</span><span class="p">);</span></div><div class='line' id='LC764'>					<span class="nx">arrowDown</span><span class="p">[</span><span class="nx">isAtBottom</span> <span class="o">?</span> <span class="s1">&#39;addClass&#39;</span> <span class="o">:</span> <span class="s1">&#39;removeClass&#39;</span><span class="p">](</span><span class="s1">&#39;jspDisabled&#39;</span><span class="p">);</span></div><div class='line' id='LC765'>				<span class="p">}</span></div><div class='line' id='LC766'>			<span class="p">}</span></div><div class='line' id='LC767'><br/></div><div class='line' id='LC768'>			<span class="kd">function</span> <span class="nx">updateHorizontalArrows</span><span class="p">(</span><span class="nx">isAtLeft</span><span class="p">,</span> <span class="nx">isAtRight</span><span class="p">)</span></div><div class='line' id='LC769'>			<span class="p">{</span></div><div class='line' id='LC770'>				<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">showArrows</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC771'>					<span class="nx">arrowLeft</span><span class="p">[</span><span class="nx">isAtLeft</span> <span class="o">?</span> <span class="s1">&#39;addClass&#39;</span> <span class="o">:</span> <span class="s1">&#39;removeClass&#39;</span><span class="p">](</span><span class="s1">&#39;jspDisabled&#39;</span><span class="p">);</span></div><div class='line' id='LC772'>					<span class="nx">arrowRight</span><span class="p">[</span><span class="nx">isAtRight</span> <span class="o">?</span> <span class="s1">&#39;addClass&#39;</span> <span class="o">:</span> <span class="s1">&#39;removeClass&#39;</span><span class="p">](</span><span class="s1">&#39;jspDisabled&#39;</span><span class="p">);</span></div><div class='line' id='LC773'>				<span class="p">}</span></div><div class='line' id='LC774'>			<span class="p">}</span></div><div class='line' id='LC775'><br/></div><div class='line' id='LC776'>			<span class="kd">function</span> <span class="nx">scrollToY</span><span class="p">(</span><span class="nx">destY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC777'>			<span class="p">{</span></div><div class='line' id='LC778'>				<span class="kd">var</span> <span class="nx">percentScrolled</span> <span class="o">=</span> <span class="nx">destY</span> <span class="o">/</span> <span class="p">(</span><span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">);</span></div><div class='line' id='LC779'>				<span class="nx">positionDragY</span><span class="p">(</span><span class="nx">percentScrolled</span> <span class="o">*</span> <span class="nx">dragMaxY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC780'>			<span class="p">}</span></div><div class='line' id='LC781'><br/></div><div class='line' id='LC782'>			<span class="kd">function</span> <span class="nx">scrollToX</span><span class="p">(</span><span class="nx">destX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC783'>			<span class="p">{</span></div><div class='line' id='LC784'>				<span class="kd">var</span> <span class="nx">percentScrolled</span> <span class="o">=</span> <span class="nx">destX</span> <span class="o">/</span> <span class="p">(</span><span class="nx">contentWidth</span> <span class="o">-</span> <span class="nx">paneWidth</span><span class="p">);</span></div><div class='line' id='LC785'>				<span class="nx">positionDragX</span><span class="p">(</span><span class="nx">percentScrolled</span> <span class="o">*</span> <span class="nx">dragMaxX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC786'>			<span class="p">}</span></div><div class='line' id='LC787'><br/></div><div class='line' id='LC788'>			<span class="kd">function</span> <span class="nx">scrollToElement</span><span class="p">(</span><span class="nx">ele</span><span class="p">,</span> <span class="nx">stickToTop</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC789'>			<span class="p">{</span></div><div class='line' id='LC790'>				<span class="kd">var</span> <span class="nx">e</span><span class="p">,</span> <span class="nx">eleHeight</span><span class="p">,</span> <span class="nx">eleWidth</span><span class="p">,</span> <span class="nx">eleTop</span> <span class="o">=</span> <span class="mi">0</span><span class="p">,</span> <span class="nx">eleLeft</span> <span class="o">=</span> <span class="mi">0</span><span class="p">,</span> <span class="nx">viewportTop</span><span class="p">,</span> <span class="nx">viewportLeft</span><span class="p">,</span> <span class="nx">maxVisibleEleTop</span><span class="p">,</span> <span class="nx">maxVisibleEleLeft</span><span class="p">,</span> <span class="nx">destY</span><span class="p">,</span> <span class="nx">destX</span><span class="p">;</span></div><div class='line' id='LC791'><br/></div><div class='line' id='LC792'>				<span class="c1">// Legal hash values aren&#39;t necessarily legal jQuery selectors so we need to catch any</span></div><div class='line' id='LC793'>				<span class="c1">// errors from the lookup...</span></div><div class='line' id='LC794'>				<span class="k">try</span> <span class="p">{</span></div><div class='line' id='LC795'>					<span class="nx">e</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="nx">ele</span><span class="p">);</span></div><div class='line' id='LC796'>				<span class="p">}</span> <span class="k">catch</span> <span class="p">(</span><span class="nx">err</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC797'>					<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC798'>				<span class="p">}</span></div><div class='line' id='LC799'>				<span class="nx">eleHeight</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">outerHeight</span><span class="p">();</span></div><div class='line' id='LC800'>				<span class="nx">eleWidth</span><span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">outerWidth</span><span class="p">();</span></div><div class='line' id='LC801'><br/></div><div class='line' id='LC802'>				<span class="nx">container</span><span class="p">.</span><span class="nx">scrollTop</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC803'>				<span class="nx">container</span><span class="p">.</span><span class="nx">scrollLeft</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC804'><br/></div><div class='line' id='LC805'>				<span class="c1">// loop through parents adding the offset top of any elements that are relatively positioned between</span></div><div class='line' id='LC806'>				<span class="c1">// the focused element and the jspPane so we can get the true distance from the top</span></div><div class='line' id='LC807'>				<span class="c1">// of the focused element to the top of the scrollpane...</span></div><div class='line' id='LC808'>				<span class="k">while</span> <span class="p">(</span><span class="o">!</span><span class="nx">e</span><span class="p">.</span><span class="nx">is</span><span class="p">(</span><span class="s1">&#39;.jspPane&#39;</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC809'>					<span class="nx">eleTop</span> <span class="o">+=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">top</span><span class="p">;</span></div><div class='line' id='LC810'>					<span class="nx">eleLeft</span> <span class="o">+=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">left</span><span class="p">;</span></div><div class='line' id='LC811'>					<span class="nx">e</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">offsetParent</span><span class="p">();</span></div><div class='line' id='LC812'>					<span class="k">if</span> <span class="p">(</span><span class="sr">/^body|html$/i</span><span class="p">.</span><span class="nx">test</span><span class="p">(</span><span class="nx">e</span><span class="p">[</span><span class="mi">0</span><span class="p">].</span><span class="nx">nodeName</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC813'>						<span class="c1">// we ended up too high in the document structure. Quit!</span></div><div class='line' id='LC814'>						<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC815'>					<span class="p">}</span></div><div class='line' id='LC816'>				<span class="p">}</span></div><div class='line' id='LC817'><br/></div><div class='line' id='LC818'>				<span class="nx">viewportTop</span> <span class="o">=</span> <span class="nx">contentPositionY</span><span class="p">();</span></div><div class='line' id='LC819'>				<span class="nx">maxVisibleEleTop</span> <span class="o">=</span> <span class="nx">viewportTop</span> <span class="o">+</span> <span class="nx">paneHeight</span><span class="p">;</span></div><div class='line' id='LC820'>				<span class="k">if</span> <span class="p">(</span><span class="nx">eleTop</span> <span class="o">&lt;</span> <span class="nx">viewportTop</span> <span class="o">||</span> <span class="nx">stickToTop</span><span class="p">)</span> <span class="p">{</span> <span class="c1">// element is above viewport</span></div><div class='line' id='LC821'>					<span class="nx">destY</span> <span class="o">=</span> <span class="nx">eleTop</span> <span class="o">-</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">verticalGutter</span><span class="p">;</span></div><div class='line' id='LC822'>				<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">eleTop</span> <span class="o">+</span> <span class="nx">eleHeight</span> <span class="o">&gt;</span> <span class="nx">maxVisibleEleTop</span><span class="p">)</span> <span class="p">{</span> <span class="c1">// element is below viewport</span></div><div class='line' id='LC823'>					<span class="nx">destY</span> <span class="o">=</span> <span class="nx">eleTop</span> <span class="o">-</span> <span class="nx">paneHeight</span> <span class="o">+</span> <span class="nx">eleHeight</span> <span class="o">+</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">verticalGutter</span><span class="p">;</span></div><div class='line' id='LC824'>				<span class="p">}</span></div><div class='line' id='LC825'>				<span class="k">if</span> <span class="p">(</span><span class="nx">destY</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC826'>					<span class="nx">scrollToY</span><span class="p">(</span><span class="nx">destY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC827'>				<span class="p">}</span></div><div class='line' id='LC828'><br/></div><div class='line' id='LC829'>				<span class="nx">viewportLeft</span> <span class="o">=</span> <span class="nx">contentPositionX</span><span class="p">();</span></div><div class='line' id='LC830'>	            <span class="nx">maxVisibleEleLeft</span> <span class="o">=</span> <span class="nx">viewportLeft</span> <span class="o">+</span> <span class="nx">paneWidth</span><span class="p">;</span></div><div class='line' id='LC831'>	            <span class="k">if</span> <span class="p">(</span><span class="nx">eleLeft</span> <span class="o">&lt;</span> <span class="nx">viewportLeft</span> <span class="o">||</span> <span class="nx">stickToTop</span><span class="p">)</span> <span class="p">{</span> <span class="c1">// element is to the left of viewport</span></div><div class='line' id='LC832'>	                <span class="nx">destX</span> <span class="o">=</span> <span class="nx">eleLeft</span> <span class="o">-</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">horizontalGutter</span><span class="p">;</span></div><div class='line' id='LC833'>	            <span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">eleLeft</span> <span class="o">+</span> <span class="nx">eleWidth</span> <span class="o">&gt;</span> <span class="nx">maxVisibleEleLeft</span><span class="p">)</span> <span class="p">{</span> <span class="c1">// element is to the right viewport</span></div><div class='line' id='LC834'>	                <span class="nx">destX</span> <span class="o">=</span> <span class="nx">eleLeft</span> <span class="o">-</span> <span class="nx">paneWidth</span> <span class="o">+</span> <span class="nx">eleWidth</span> <span class="o">+</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">horizontalGutter</span><span class="p">;</span></div><div class='line' id='LC835'>	            <span class="p">}</span></div><div class='line' id='LC836'>	            <span class="k">if</span> <span class="p">(</span><span class="nx">destX</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC837'>	                <span class="nx">scrollToX</span><span class="p">(</span><span class="nx">destX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC838'>	            <span class="p">}</span></div><div class='line' id='LC839'><br/></div><div class='line' id='LC840'>			<span class="p">}</span></div><div class='line' id='LC841'><br/></div><div class='line' id='LC842'>			<span class="kd">function</span> <span class="nx">contentPositionX</span><span class="p">()</span></div><div class='line' id='LC843'>			<span class="p">{</span></div><div class='line' id='LC844'>				<span class="k">return</span> <span class="o">-</span><span class="nx">pane</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">left</span><span class="p">;</span></div><div class='line' id='LC845'>			<span class="p">}</span></div><div class='line' id='LC846'><br/></div><div class='line' id='LC847'>			<span class="kd">function</span> <span class="nx">contentPositionY</span><span class="p">()</span></div><div class='line' id='LC848'>			<span class="p">{</span></div><div class='line' id='LC849'>				<span class="k">return</span> <span class="o">-</span><span class="nx">pane</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">top</span><span class="p">;</span></div><div class='line' id='LC850'>			<span class="p">}</span></div><div class='line' id='LC851'><br/></div><div class='line' id='LC852'>			<span class="kd">function</span> <span class="nx">isCloseToBottom</span><span class="p">()</span></div><div class='line' id='LC853'>			<span class="p">{</span></div><div class='line' id='LC854'>				<span class="kd">var</span> <span class="nx">scrollableHeight</span> <span class="o">=</span> <span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">;</span></div><div class='line' id='LC855'>				<span class="k">return</span> <span class="p">(</span><span class="nx">scrollableHeight</span> <span class="o">&gt;</span> <span class="mi">20</span><span class="p">)</span> <span class="o">&amp;&amp;</span> <span class="p">(</span><span class="nx">scrollableHeight</span> <span class="o">-</span> <span class="nx">contentPositionY</span><span class="p">()</span> <span class="o">&lt;</span> <span class="mi">10</span><span class="p">);</span></div><div class='line' id='LC856'>			<span class="p">}</span></div><div class='line' id='LC857'><br/></div><div class='line' id='LC858'>			<span class="kd">function</span> <span class="nx">isCloseToRight</span><span class="p">()</span></div><div class='line' id='LC859'>			<span class="p">{</span></div><div class='line' id='LC860'>				<span class="kd">var</span> <span class="nx">scrollableWidth</span> <span class="o">=</span> <span class="nx">contentWidth</span> <span class="o">-</span> <span class="nx">paneWidth</span><span class="p">;</span></div><div class='line' id='LC861'>				<span class="k">return</span> <span class="p">(</span><span class="nx">scrollableWidth</span> <span class="o">&gt;</span> <span class="mi">20</span><span class="p">)</span> <span class="o">&amp;&amp;</span> <span class="p">(</span><span class="nx">scrollableWidth</span> <span class="o">-</span> <span class="nx">contentPositionX</span><span class="p">()</span> <span class="o">&lt;</span> <span class="mi">10</span><span class="p">);</span></div><div class='line' id='LC862'>			<span class="p">}</span></div><div class='line' id='LC863'><br/></div><div class='line' id='LC864'>			<span class="kd">function</span> <span class="nx">initMousewheel</span><span class="p">()</span></div><div class='line' id='LC865'>			<span class="p">{</span></div><div class='line' id='LC866'>				<span class="nx">container</span><span class="p">.</span><span class="nx">unbind</span><span class="p">(</span><span class="nx">mwEvent</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC867'>					<span class="nx">mwEvent</span><span class="p">,</span></div><div class='line' id='LC868'>					<span class="kd">function</span> <span class="p">(</span><span class="nx">event</span><span class="p">,</span> <span class="nx">delta</span><span class="p">,</span> <span class="nx">deltaX</span><span class="p">,</span> <span class="nx">deltaY</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC869'>						<span class="kd">var</span> <span class="nx">dX</span> <span class="o">=</span> <span class="nx">horizontalDragPosition</span><span class="p">,</span> <span class="nx">dY</span> <span class="o">=</span> <span class="nx">verticalDragPosition</span><span class="p">;</span></div><div class='line' id='LC870'>						<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollBy</span><span class="p">(</span><span class="nx">deltaX</span> <span class="o">*</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">mouseWheelSpeed</span><span class="p">,</span> <span class="o">-</span><span class="nx">deltaY</span> <span class="o">*</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">mouseWheelSpeed</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC871'>						<span class="c1">// return true if there was no movement so rest of screen can scroll</span></div><div class='line' id='LC872'>						<span class="k">return</span> <span class="nx">dX</span> <span class="o">==</span> <span class="nx">horizontalDragPosition</span> <span class="o">&amp;&amp;</span> <span class="nx">dY</span> <span class="o">==</span> <span class="nx">verticalDragPosition</span><span class="p">;</span></div><div class='line' id='LC873'>					<span class="p">}</span></div><div class='line' id='LC874'>				<span class="p">);</span></div><div class='line' id='LC875'>			<span class="p">}</span></div><div class='line' id='LC876'><br/></div><div class='line' id='LC877'>			<span class="kd">function</span> <span class="nx">removeMousewheel</span><span class="p">()</span></div><div class='line' id='LC878'>			<span class="p">{</span></div><div class='line' id='LC879'>				<span class="nx">container</span><span class="p">.</span><span class="nx">unbind</span><span class="p">(</span><span class="nx">mwEvent</span><span class="p">);</span></div><div class='line' id='LC880'>			<span class="p">}</span></div><div class='line' id='LC881'><br/></div><div class='line' id='LC882'>			<span class="kd">function</span> <span class="nx">nil</span><span class="p">()</span></div><div class='line' id='LC883'>			<span class="p">{</span></div><div class='line' id='LC884'>				<span class="k">return</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC885'>			<span class="p">}</span></div><div class='line' id='LC886'><br/></div><div class='line' id='LC887'>			<span class="kd">function</span> <span class="nx">initFocusHandler</span><span class="p">()</span></div><div class='line' id='LC888'>			<span class="p">{</span></div><div class='line' id='LC889'>				<span class="nx">pane</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;:input,a&#39;</span><span class="p">).</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;focus.jsp&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC890'>					<span class="s1">&#39;focus.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC891'>					<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC892'>					<span class="p">{</span></div><div class='line' id='LC893'>						<span class="nx">scrollToElement</span><span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">target</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC894'>					<span class="p">}</span></div><div class='line' id='LC895'>				<span class="p">);</span></div><div class='line' id='LC896'>			<span class="p">}</span></div><div class='line' id='LC897'><br/></div><div class='line' id='LC898'>			<span class="kd">function</span> <span class="nx">removeFocusHandler</span><span class="p">()</span></div><div class='line' id='LC899'>			<span class="p">{</span></div><div class='line' id='LC900'>				<span class="nx">pane</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;:input,a&#39;</span><span class="p">).</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;focus.jsp&#39;</span><span class="p">);</span></div><div class='line' id='LC901'>			<span class="p">}</span></div><div class='line' id='LC902'><br/></div><div class='line' id='LC903'>			<span class="kd">function</span> <span class="nx">initKeyboardNav</span><span class="p">()</span></div><div class='line' id='LC904'>			<span class="p">{</span></div><div class='line' id='LC905'>				<span class="kd">var</span> <span class="nx">keyDown</span><span class="p">,</span> <span class="nx">elementHasScrolled</span><span class="p">,</span> <span class="nx">validParents</span> <span class="o">=</span> <span class="p">[];</span></div><div class='line' id='LC906'>				<span class="nx">isScrollableH</span> <span class="o">&amp;&amp;</span> <span class="nx">validParents</span><span class="p">.</span><span class="nx">push</span><span class="p">(</span><span class="nx">horizontalBar</span><span class="p">[</span><span class="mi">0</span><span class="p">]);</span></div><div class='line' id='LC907'>				<span class="nx">isScrollableV</span> <span class="o">&amp;&amp;</span> <span class="nx">validParents</span><span class="p">.</span><span class="nx">push</span><span class="p">(</span><span class="nx">verticalBar</span><span class="p">[</span><span class="mi">0</span><span class="p">]);</span></div><div class='line' id='LC908'><br/></div><div class='line' id='LC909'>				<span class="c1">// IE also focuses elements that don&#39;t have tabindex set.</span></div><div class='line' id='LC910'>				<span class="nx">pane</span><span class="p">.</span><span class="nx">focus</span><span class="p">(</span></div><div class='line' id='LC911'>					<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC912'>					<span class="p">{</span></div><div class='line' id='LC913'>						<span class="nx">elem</span><span class="p">.</span><span class="nx">focus</span><span class="p">();</span></div><div class='line' id='LC914'>					<span class="p">}</span></div><div class='line' id='LC915'>				<span class="p">);</span></div><div class='line' id='LC916'><br/></div><div class='line' id='LC917'>				<span class="nx">elem</span><span class="p">.</span><span class="nx">attr</span><span class="p">(</span><span class="s1">&#39;tabindex&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">)</span></div><div class='line' id='LC918'>					<span class="p">.</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;keydown.jsp keypress.jsp&#39;</span><span class="p">)</span></div><div class='line' id='LC919'>					<span class="p">.</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC920'>						<span class="s1">&#39;keydown.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC921'>						<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC922'>						<span class="p">{</span></div><div class='line' id='LC923'>							<span class="k">if</span> <span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">target</span> <span class="o">!==</span> <span class="k">this</span> <span class="o">&amp;&amp;</span> <span class="o">!</span><span class="p">(</span><span class="nx">validParents</span><span class="p">.</span><span class="nx">length</span> <span class="o">&amp;&amp;</span> <span class="nx">$</span><span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">target</span><span class="p">).</span><span class="nx">closest</span><span class="p">(</span><span class="nx">validParents</span><span class="p">).</span><span class="nx">length</span><span class="p">)){</span></div><div class='line' id='LC924'>								<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC925'>							<span class="p">}</span></div><div class='line' id='LC926'>							<span class="kd">var</span> <span class="nx">dX</span> <span class="o">=</span> <span class="nx">horizontalDragPosition</span><span class="p">,</span> <span class="nx">dY</span> <span class="o">=</span> <span class="nx">verticalDragPosition</span><span class="p">;</span></div><div class='line' id='LC927'>							<span class="k">switch</span><span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">keyCode</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC928'>								<span class="k">case</span> <span class="mi">40</span><span class="o">:</span> <span class="c1">// down</span></div><div class='line' id='LC929'>								<span class="k">case</span> <span class="mi">38</span><span class="o">:</span> <span class="c1">// up</span></div><div class='line' id='LC930'>								<span class="k">case</span> <span class="mi">34</span><span class="o">:</span> <span class="c1">// page down</span></div><div class='line' id='LC931'>								<span class="k">case</span> <span class="mi">32</span><span class="o">:</span> <span class="c1">// space</span></div><div class='line' id='LC932'>								<span class="k">case</span> <span class="mi">33</span><span class="o">:</span> <span class="c1">// page up</span></div><div class='line' id='LC933'>								<span class="k">case</span> <span class="mi">39</span><span class="o">:</span> <span class="c1">// right</span></div><div class='line' id='LC934'>								<span class="k">case</span> <span class="mi">37</span><span class="o">:</span> <span class="c1">// left</span></div><div class='line' id='LC935'>									<span class="nx">keyDown</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">keyCode</span><span class="p">;</span></div><div class='line' id='LC936'>									<span class="nx">keyDownHandler</span><span class="p">();</span></div><div class='line' id='LC937'>									<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC938'>								<span class="k">case</span> <span class="mi">35</span><span class="o">:</span> <span class="c1">// end</span></div><div class='line' id='LC939'>									<span class="nx">scrollToY</span><span class="p">(</span><span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">);</span></div><div class='line' id='LC940'>									<span class="nx">keyDown</span> <span class="o">=</span> <span class="kc">null</span><span class="p">;</span></div><div class='line' id='LC941'>									<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC942'>								<span class="k">case</span> <span class="mi">36</span><span class="o">:</span> <span class="c1">// home</span></div><div class='line' id='LC943'>									<span class="nx">scrollToY</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC944'>									<span class="nx">keyDown</span> <span class="o">=</span> <span class="kc">null</span><span class="p">;</span></div><div class='line' id='LC945'>									<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC946'>							<span class="p">}</span></div><div class='line' id='LC947'><br/></div><div class='line' id='LC948'>							<span class="nx">elementHasScrolled</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">keyCode</span> <span class="o">==</span> <span class="nx">keyDown</span> <span class="o">&amp;&amp;</span> <span class="nx">dX</span> <span class="o">!=</span> <span class="nx">horizontalDragPosition</span> <span class="o">||</span> <span class="nx">dY</span> <span class="o">!=</span> <span class="nx">verticalDragPosition</span><span class="p">;</span></div><div class='line' id='LC949'>							<span class="k">return</span> <span class="o">!</span><span class="nx">elementHasScrolled</span><span class="p">;</span></div><div class='line' id='LC950'>						<span class="p">}</span></div><div class='line' id='LC951'>					<span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC952'>						<span class="s1">&#39;keypress.jsp&#39;</span><span class="p">,</span> <span class="c1">// For FF/ OSX so that we can cancel the repeat key presses if the JSP scrolls...</span></div><div class='line' id='LC953'>						<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC954'>						<span class="p">{</span></div><div class='line' id='LC955'>							<span class="k">if</span> <span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">keyCode</span> <span class="o">==</span> <span class="nx">keyDown</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC956'>								<span class="nx">keyDownHandler</span><span class="p">();</span></div><div class='line' id='LC957'>							<span class="p">}</span></div><div class='line' id='LC958'>							<span class="k">return</span> <span class="o">!</span><span class="nx">elementHasScrolled</span><span class="p">;</span></div><div class='line' id='LC959'>						<span class="p">}</span></div><div class='line' id='LC960'>					<span class="p">);</span></div><div class='line' id='LC961'><br/></div><div class='line' id='LC962'>				<span class="k">if</span> <span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">hideFocus</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC963'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;outline&#39;</span><span class="p">,</span> <span class="s1">&#39;none&#39;</span><span class="p">);</span></div><div class='line' id='LC964'>					<span class="k">if</span> <span class="p">(</span><span class="s1">&#39;hideFocus&#39;</span> <span class="k">in</span> <span class="nx">container</span><span class="p">[</span><span class="mi">0</span><span class="p">]){</span></div><div class='line' id='LC965'>						<span class="nx">elem</span><span class="p">.</span><span class="nx">attr</span><span class="p">(</span><span class="s1">&#39;hideFocus&#39;</span><span class="p">,</span> <span class="kc">true</span><span class="p">);</span></div><div class='line' id='LC966'>					<span class="p">}</span></div><div class='line' id='LC967'>				<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC968'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;outline&#39;</span><span class="p">,</span> <span class="s1">&#39;&#39;</span><span class="p">);</span></div><div class='line' id='LC969'>					<span class="k">if</span> <span class="p">(</span><span class="s1">&#39;hideFocus&#39;</span> <span class="k">in</span> <span class="nx">container</span><span class="p">[</span><span class="mi">0</span><span class="p">]){</span></div><div class='line' id='LC970'>						<span class="nx">elem</span><span class="p">.</span><span class="nx">attr</span><span class="p">(</span><span class="s1">&#39;hideFocus&#39;</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC971'>					<span class="p">}</span></div><div class='line' id='LC972'>				<span class="p">}</span></div><div class='line' id='LC973'><br/></div><div class='line' id='LC974'>				<span class="kd">function</span> <span class="nx">keyDownHandler</span><span class="p">()</span></div><div class='line' id='LC975'>				<span class="p">{</span></div><div class='line' id='LC976'>					<span class="kd">var</span> <span class="nx">dX</span> <span class="o">=</span> <span class="nx">horizontalDragPosition</span><span class="p">,</span> <span class="nx">dY</span> <span class="o">=</span> <span class="nx">verticalDragPosition</span><span class="p">;</span></div><div class='line' id='LC977'>					<span class="k">switch</span><span class="p">(</span><span class="nx">keyDown</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC978'>						<span class="k">case</span> <span class="mi">40</span><span class="o">:</span> <span class="c1">// down</span></div><div class='line' id='LC979'>							<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByY</span><span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">keyboardSpeed</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC980'>							<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC981'>						<span class="k">case</span> <span class="mi">38</span><span class="o">:</span> <span class="c1">// up</span></div><div class='line' id='LC982'>							<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByY</span><span class="p">(</span><span class="o">-</span><span class="nx">settings</span><span class="p">.</span><span class="nx">keyboardSpeed</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC983'>							<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC984'>						<span class="k">case</span> <span class="mi">34</span><span class="o">:</span> <span class="c1">// page down</span></div><div class='line' id='LC985'>						<span class="k">case</span> <span class="mi">32</span><span class="o">:</span> <span class="c1">// space</span></div><div class='line' id='LC986'>							<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByY</span><span class="p">(</span><span class="nx">paneHeight</span> <span class="o">*</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">scrollPagePercent</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC987'>							<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC988'>						<span class="k">case</span> <span class="mi">33</span><span class="o">:</span> <span class="c1">// page up</span></div><div class='line' id='LC989'>							<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByY</span><span class="p">(</span><span class="o">-</span><span class="nx">paneHeight</span> <span class="o">*</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">scrollPagePercent</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC990'>							<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC991'>						<span class="k">case</span> <span class="mi">39</span><span class="o">:</span> <span class="c1">// right</span></div><div class='line' id='LC992'>							<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByX</span><span class="p">(</span><span class="nx">settings</span><span class="p">.</span><span class="nx">keyboardSpeed</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC993'>							<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC994'>						<span class="k">case</span> <span class="mi">37</span><span class="o">:</span> <span class="c1">// left</span></div><div class='line' id='LC995'>							<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByX</span><span class="p">(</span><span class="o">-</span><span class="nx">settings</span><span class="p">.</span><span class="nx">keyboardSpeed</span><span class="p">,</span> <span class="kc">false</span><span class="p">);</span></div><div class='line' id='LC996'>							<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC997'>					<span class="p">}</span></div><div class='line' id='LC998'><br/></div><div class='line' id='LC999'>					<span class="nx">elementHasScrolled</span> <span class="o">=</span> <span class="nx">dX</span> <span class="o">!=</span> <span class="nx">horizontalDragPosition</span> <span class="o">||</span> <span class="nx">dY</span> <span class="o">!=</span> <span class="nx">verticalDragPosition</span><span class="p">;</span></div><div class='line' id='LC1000'>					<span class="k">return</span> <span class="nx">elementHasScrolled</span><span class="p">;</span></div><div class='line' id='LC1001'>				<span class="p">}</span></div><div class='line' id='LC1002'>			<span class="p">}</span></div><div class='line' id='LC1003'><br/></div><div class='line' id='LC1004'>			<span class="kd">function</span> <span class="nx">removeKeyboardNav</span><span class="p">()</span></div><div class='line' id='LC1005'>			<span class="p">{</span></div><div class='line' id='LC1006'>				<span class="nx">elem</span><span class="p">.</span><span class="nx">attr</span><span class="p">(</span><span class="s1">&#39;tabindex&#39;</span><span class="p">,</span> <span class="s1">&#39;-1&#39;</span><span class="p">)</span></div><div class='line' id='LC1007'>					<span class="p">.</span><span class="nx">removeAttr</span><span class="p">(</span><span class="s1">&#39;tabindex&#39;</span><span class="p">)</span></div><div class='line' id='LC1008'>					<span class="p">.</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;keydown.jsp keypress.jsp&#39;</span><span class="p">);</span></div><div class='line' id='LC1009'>			<span class="p">}</span></div><div class='line' id='LC1010'><br/></div><div class='line' id='LC1011'>			<span class="kd">function</span> <span class="nx">observeHash</span><span class="p">()</span></div><div class='line' id='LC1012'>			<span class="p">{</span></div><div class='line' id='LC1013'>				<span class="k">if</span> <span class="p">(</span><span class="nx">location</span><span class="p">.</span><span class="nx">hash</span> <span class="o">&amp;&amp;</span> <span class="nx">location</span><span class="p">.</span><span class="nx">hash</span><span class="p">.</span><span class="nx">length</span> <span class="o">&gt;</span> <span class="mi">1</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1014'>					<span class="kd">var</span> <span class="nx">e</span><span class="p">,</span></div><div class='line' id='LC1015'>						<span class="nx">retryInt</span><span class="p">,</span></div><div class='line' id='LC1016'>						<span class="nx">hash</span> <span class="o">=</span> <span class="nx">escape</span><span class="p">(</span><span class="nx">location</span><span class="p">.</span><span class="nx">hash</span><span class="p">.</span><span class="nx">substr</span><span class="p">(</span><span class="mi">1</span><span class="p">))</span> <span class="c1">// hash must be escaped to prevent XSS</span></div><div class='line' id='LC1017'>						<span class="p">;</span></div><div class='line' id='LC1018'>					<span class="k">try</span> <span class="p">{</span></div><div class='line' id='LC1019'>						<span class="nx">e</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;#&#39;</span> <span class="o">+</span> <span class="nx">hash</span> <span class="o">+</span> <span class="s1">&#39;, a[name=&quot;&#39;</span> <span class="o">+</span> <span class="nx">hash</span> <span class="o">+</span> <span class="s1">&#39;&quot;]&#39;</span><span class="p">);</span></div><div class='line' id='LC1020'>					<span class="p">}</span> <span class="k">catch</span> <span class="p">(</span><span class="nx">err</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1021'>						<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC1022'>					<span class="p">}</span></div><div class='line' id='LC1023'><br/></div><div class='line' id='LC1024'>					<span class="k">if</span> <span class="p">(</span><span class="nx">e</span><span class="p">.</span><span class="nx">length</span> <span class="o">&amp;&amp;</span> <span class="nx">pane</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="nx">hash</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC1025'>						<span class="c1">// nasty workaround but it appears to take a little while before the hash has done its thing</span></div><div class='line' id='LC1026'>						<span class="c1">// to the rendered page so we just wait until the container&#39;s scrollTop has been messed up.</span></div><div class='line' id='LC1027'>						<span class="k">if</span> <span class="p">(</span><span class="nx">container</span><span class="p">.</span><span class="nx">scrollTop</span><span class="p">()</span> <span class="o">===</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1028'>							<span class="nx">retryInt</span> <span class="o">=</span> <span class="nx">setInterval</span><span class="p">(</span></div><div class='line' id='LC1029'>								<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1030'>								<span class="p">{</span></div><div class='line' id='LC1031'>									<span class="k">if</span> <span class="p">(</span><span class="nx">container</span><span class="p">.</span><span class="nx">scrollTop</span><span class="p">()</span> <span class="o">&gt;</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1032'>										<span class="nx">scrollToElement</span><span class="p">(</span><span class="nx">e</span><span class="p">,</span> <span class="kc">true</span><span class="p">);</span></div><div class='line' id='LC1033'>										<span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">).</span><span class="nx">scrollTop</span><span class="p">(</span><span class="nx">container</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">top</span><span class="p">);</span></div><div class='line' id='LC1034'>										<span class="nx">clearInterval</span><span class="p">(</span><span class="nx">retryInt</span><span class="p">);</span></div><div class='line' id='LC1035'>									<span class="p">}</span></div><div class='line' id='LC1036'>								<span class="p">},</span></div><div class='line' id='LC1037'>								<span class="mi">50</span></div><div class='line' id='LC1038'>							<span class="p">);</span></div><div class='line' id='LC1039'>						<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC1040'>							<span class="nx">scrollToElement</span><span class="p">(</span><span class="nx">e</span><span class="p">,</span> <span class="kc">true</span><span class="p">);</span></div><div class='line' id='LC1041'>							<span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">).</span><span class="nx">scrollTop</span><span class="p">(</span><span class="nx">container</span><span class="p">.</span><span class="nx">position</span><span class="p">().</span><span class="nx">top</span><span class="p">);</span></div><div class='line' id='LC1042'>						<span class="p">}</span></div><div class='line' id='LC1043'>					<span class="p">}</span></div><div class='line' id='LC1044'>				<span class="p">}</span></div><div class='line' id='LC1045'>			<span class="p">}</span></div><div class='line' id='LC1046'><br/></div><div class='line' id='LC1047'>			<span class="kd">function</span> <span class="nx">hijackInternalLinks</span><span class="p">()</span></div><div class='line' id='LC1048'>			<span class="p">{</span></div><div class='line' id='LC1049'>				<span class="c1">// only register the link handler once</span></div><div class='line' id='LC1050'>				<span class="k">if</span> <span class="p">(</span><span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">.</span><span class="nx">body</span><span class="p">).</span><span class="nx">data</span><span class="p">(</span><span class="s1">&#39;jspHijack&#39;</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC1051'>					<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC1052'>				<span class="p">}</span></div><div class='line' id='LC1053'><br/></div><div class='line' id='LC1054'>				<span class="c1">// remember that the handler was bound</span></div><div class='line' id='LC1055'>				<span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">.</span><span class="nx">body</span><span class="p">).</span><span class="nx">data</span><span class="p">(</span><span class="s1">&#39;jspHijack&#39;</span><span class="p">,</span> <span class="kc">true</span><span class="p">);</span></div><div class='line' id='LC1056'><br/></div><div class='line' id='LC1057'>				<span class="c1">// use live handler to also capture newly created links</span></div><div class='line' id='LC1058'>				<span class="nx">$</span><span class="p">(</span><span class="nb">document</span><span class="p">.</span><span class="nx">body</span><span class="p">).</span><span class="nx">delegate</span><span class="p">(</span><span class="s1">&#39;a[href*=#]&#39;</span><span class="p">,</span> <span class="s1">&#39;click&#39;</span><span class="p">,</span> <span class="kd">function</span><span class="p">(</span><span class="nx">event</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1059'>					<span class="c1">// does the link point to the same page?</span></div><div class='line' id='LC1060'>					<span class="c1">// this also takes care of cases with a &lt;base&gt;-Tag or Links not starting with the hash #</span></div><div class='line' id='LC1061'>					<span class="c1">// e.g. &lt;a href=&quot;index.html#test&quot;&gt; when the current url already is index.html</span></div><div class='line' id='LC1062'>					<span class="kd">var</span> <span class="nx">href</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">href</span><span class="p">.</span><span class="nx">substr</span><span class="p">(</span><span class="mi">0</span><span class="p">,</span> <span class="k">this</span><span class="p">.</span><span class="nx">href</span><span class="p">.</span><span class="nx">indexOf</span><span class="p">(</span><span class="s1">&#39;#&#39;</span><span class="p">)),</span></div><div class='line' id='LC1063'>						<span class="nx">locationHref</span> <span class="o">=</span> <span class="nx">location</span><span class="p">.</span><span class="nx">href</span><span class="p">,</span></div><div class='line' id='LC1064'>						<span class="nx">hash</span><span class="p">,</span></div><div class='line' id='LC1065'>						<span class="nx">element</span><span class="p">,</span></div><div class='line' id='LC1066'>						<span class="nx">container</span><span class="p">,</span></div><div class='line' id='LC1067'>						<span class="nx">jsp</span><span class="p">,</span></div><div class='line' id='LC1068'>						<span class="nx">scrollTop</span><span class="p">,</span></div><div class='line' id='LC1069'>						<span class="nx">elementTop</span><span class="p">;</span></div><div class='line' id='LC1070'>					<span class="k">if</span> <span class="p">(</span><span class="nx">location</span><span class="p">.</span><span class="nx">href</span><span class="p">.</span><span class="nx">indexOf</span><span class="p">(</span><span class="s1">&#39;#&#39;</span><span class="p">)</span> <span class="o">!==</span> <span class="o">-</span><span class="mi">1</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1071'>						<span class="nx">locationHref</span> <span class="o">=</span> <span class="nx">location</span><span class="p">.</span><span class="nx">href</span><span class="p">.</span><span class="nx">substr</span><span class="p">(</span><span class="mi">0</span><span class="p">,</span> <span class="nx">location</span><span class="p">.</span><span class="nx">href</span><span class="p">.</span><span class="nx">indexOf</span><span class="p">(</span><span class="s1">&#39;#&#39;</span><span class="p">));</span></div><div class='line' id='LC1072'>					<span class="p">}</span></div><div class='line' id='LC1073'>					<span class="k">if</span> <span class="p">(</span><span class="nx">href</span> <span class="o">!==</span> <span class="nx">locationHref</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1074'>						<span class="c1">// the link points to another page</span></div><div class='line' id='LC1075'>						<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC1076'>					<span class="p">}</span></div><div class='line' id='LC1077'><br/></div><div class='line' id='LC1078'>					<span class="c1">// check if jScrollPane should handle this click event</span></div><div class='line' id='LC1079'>					<span class="nx">hash</span> <span class="o">=</span> <span class="nx">escape</span><span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">href</span><span class="p">.</span><span class="nx">substr</span><span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">href</span><span class="p">.</span><span class="nx">indexOf</span><span class="p">(</span><span class="s1">&#39;#&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="mi">1</span><span class="p">));</span></div><div class='line' id='LC1080'><br/></div><div class='line' id='LC1081'>					<span class="c1">// find the element on the page</span></div><div class='line' id='LC1082'>					<span class="nx">element</span><span class="p">;</span></div><div class='line' id='LC1083'>					<span class="k">try</span> <span class="p">{</span></div><div class='line' id='LC1084'>						<span class="nx">element</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;#&#39;</span> <span class="o">+</span> <span class="nx">hash</span> <span class="o">+</span> <span class="s1">&#39;, a[name=&quot;&#39;</span> <span class="o">+</span> <span class="nx">hash</span> <span class="o">+</span> <span class="s1">&#39;&quot;]&#39;</span><span class="p">);</span></div><div class='line' id='LC1085'>					<span class="p">}</span> <span class="k">catch</span> <span class="p">(</span><span class="nx">e</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1086'>						<span class="c1">// hash is not a valid jQuery identifier</span></div><div class='line' id='LC1087'>						<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC1088'>					<span class="p">}</span></div><div class='line' id='LC1089'><br/></div><div class='line' id='LC1090'>					<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nx">element</span><span class="p">.</span><span class="nx">length</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1091'>						<span class="c1">// this link does not point to an element on this page</span></div><div class='line' id='LC1092'>						<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC1093'>					<span class="p">}</span></div><div class='line' id='LC1094'><br/></div><div class='line' id='LC1095'>					<span class="nx">container</span> <span class="o">=</span> <span class="nx">element</span><span class="p">.</span><span class="nx">closest</span><span class="p">(</span><span class="s1">&#39;.jspScrollable&#39;</span><span class="p">);</span></div><div class='line' id='LC1096'>					<span class="nx">jsp</span> <span class="o">=</span> <span class="nx">container</span><span class="p">.</span><span class="nx">data</span><span class="p">(</span><span class="s1">&#39;jsp&#39;</span><span class="p">);</span></div><div class='line' id='LC1097'><br/></div><div class='line' id='LC1098'>					<span class="c1">// jsp might be another jsp instance than the one, that bound this event</span></div><div class='line' id='LC1099'>					<span class="c1">// remember: this event is only bound once for all instances.</span></div><div class='line' id='LC1100'>					<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollToElement</span><span class="p">(</span><span class="nx">element</span><span class="p">,</span> <span class="kc">true</span><span class="p">);</span></div><div class='line' id='LC1101'><br/></div><div class='line' id='LC1102'>					<span class="k">if</span> <span class="p">(</span><span class="nx">container</span><span class="p">[</span><span class="mi">0</span><span class="p">].</span><span class="nx">scrollIntoView</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1103'>						<span class="c1">// also scroll to the top of the container (if it is not visible)</span></div><div class='line' id='LC1104'>						<span class="nx">scrollTop</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="nb">window</span><span class="p">).</span><span class="nx">scrollTop</span><span class="p">();</span></div><div class='line' id='LC1105'>						<span class="nx">elementTop</span> <span class="o">=</span> <span class="nx">element</span><span class="p">.</span><span class="nx">offset</span><span class="p">().</span><span class="nx">top</span><span class="p">;</span></div><div class='line' id='LC1106'>						<span class="k">if</span> <span class="p">(</span><span class="nx">elementTop</span> <span class="o">&lt;</span> <span class="nx">scrollTop</span> <span class="o">||</span> <span class="nx">elementTop</span> <span class="o">&gt;</span> <span class="nx">scrollTop</span> <span class="o">+</span> <span class="nx">$</span><span class="p">(</span><span class="nb">window</span><span class="p">).</span><span class="nx">height</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC1107'>							<span class="nx">container</span><span class="p">[</span><span class="mi">0</span><span class="p">].</span><span class="nx">scrollIntoView</span><span class="p">();</span></div><div class='line' id='LC1108'>						<span class="p">}</span></div><div class='line' id='LC1109'>					<span class="p">}</span></div><div class='line' id='LC1110'><br/></div><div class='line' id='LC1111'>					<span class="c1">// jsp handled this event, prevent the browser default (scrolling :P)</span></div><div class='line' id='LC1112'>					<span class="nx">event</span><span class="p">.</span><span class="nx">preventDefault</span><span class="p">();</span></div><div class='line' id='LC1113'>				<span class="p">});</span></div><div class='line' id='LC1114'>			<span class="p">}</span></div><div class='line' id='LC1115'><br/></div><div class='line' id='LC1116'>			<span class="c1">// Init touch on iPad, iPhone, iPod, Android</span></div><div class='line' id='LC1117'>			<span class="kd">function</span> <span class="nx">initTouch</span><span class="p">()</span></div><div class='line' id='LC1118'>			<span class="p">{</span></div><div class='line' id='LC1119'>				<span class="kd">var</span> <span class="nx">startX</span><span class="p">,</span></div><div class='line' id='LC1120'>					<span class="nx">startY</span><span class="p">,</span></div><div class='line' id='LC1121'>					<span class="nx">touchStartX</span><span class="p">,</span></div><div class='line' id='LC1122'>					<span class="nx">touchStartY</span><span class="p">,</span></div><div class='line' id='LC1123'>					<span class="nx">moved</span><span class="p">,</span></div><div class='line' id='LC1124'>					<span class="nx">moving</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC1125'>&nbsp;&nbsp;</div><div class='line' id='LC1126'>				<span class="nx">container</span><span class="p">.</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick&#39;</span><span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC1127'>					<span class="s1">&#39;touchstart.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC1128'>					<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC1129'>					<span class="p">{</span></div><div class='line' id='LC1130'>						<span class="kd">var</span> <span class="nx">touch</span> <span class="o">=</span> <span class="nx">e</span><span class="p">.</span><span class="nx">originalEvent</span><span class="p">.</span><span class="nx">touches</span><span class="p">[</span><span class="mi">0</span><span class="p">];</span></div><div class='line' id='LC1131'>						<span class="nx">startX</span> <span class="o">=</span> <span class="nx">contentPositionX</span><span class="p">();</span></div><div class='line' id='LC1132'>						<span class="nx">startY</span> <span class="o">=</span> <span class="nx">contentPositionY</span><span class="p">();</span></div><div class='line' id='LC1133'>						<span class="nx">touchStartX</span> <span class="o">=</span> <span class="nx">touch</span><span class="p">.</span><span class="nx">pageX</span><span class="p">;</span></div><div class='line' id='LC1134'>						<span class="nx">touchStartY</span> <span class="o">=</span> <span class="nx">touch</span><span class="p">.</span><span class="nx">pageY</span><span class="p">;</span></div><div class='line' id='LC1135'>						<span class="nx">moved</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC1136'>						<span class="nx">moving</span> <span class="o">=</span> <span class="kc">true</span><span class="p">;</span></div><div class='line' id='LC1137'>					<span class="p">}</span></div><div class='line' id='LC1138'>				<span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC1139'>					<span class="s1">&#39;touchmove.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC1140'>					<span class="kd">function</span><span class="p">(</span><span class="nx">ev</span><span class="p">)</span></div><div class='line' id='LC1141'>					<span class="p">{</span></div><div class='line' id='LC1142'>						<span class="k">if</span><span class="p">(</span><span class="o">!</span><span class="nx">moving</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1143'>							<span class="k">return</span><span class="p">;</span></div><div class='line' id='LC1144'>						<span class="p">}</span></div><div class='line' id='LC1145'><br/></div><div class='line' id='LC1146'>						<span class="kd">var</span> <span class="nx">touchPos</span> <span class="o">=</span> <span class="nx">ev</span><span class="p">.</span><span class="nx">originalEvent</span><span class="p">.</span><span class="nx">touches</span><span class="p">[</span><span class="mi">0</span><span class="p">],</span></div><div class='line' id='LC1147'>							<span class="nx">dX</span> <span class="o">=</span> <span class="nx">horizontalDragPosition</span><span class="p">,</span> <span class="nx">dY</span> <span class="o">=</span> <span class="nx">verticalDragPosition</span><span class="p">;</span></div><div class='line' id='LC1148'><br/></div><div class='line' id='LC1149'>						<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollTo</span><span class="p">(</span><span class="nx">startX</span> <span class="o">+</span> <span class="nx">touchStartX</span> <span class="o">-</span> <span class="nx">touchPos</span><span class="p">.</span><span class="nx">pageX</span><span class="p">,</span> <span class="nx">startY</span> <span class="o">+</span> <span class="nx">touchStartY</span> <span class="o">-</span> <span class="nx">touchPos</span><span class="p">.</span><span class="nx">pageY</span><span class="p">);</span></div><div class='line' id='LC1150'><br/></div><div class='line' id='LC1151'>						<span class="nx">moved</span> <span class="o">=</span> <span class="nx">moved</span> <span class="o">||</span> <span class="nb">Math</span><span class="p">.</span><span class="nx">abs</span><span class="p">(</span><span class="nx">touchStartX</span> <span class="o">-</span> <span class="nx">touchPos</span><span class="p">.</span><span class="nx">pageX</span><span class="p">)</span> <span class="o">&gt;</span> <span class="mi">5</span> <span class="o">||</span> <span class="nb">Math</span><span class="p">.</span><span class="nx">abs</span><span class="p">(</span><span class="nx">touchStartY</span> <span class="o">-</span> <span class="nx">touchPos</span><span class="p">.</span><span class="nx">pageY</span><span class="p">)</span> <span class="o">&gt;</span> <span class="mi">5</span><span class="p">;</span></div><div class='line' id='LC1152'><br/></div><div class='line' id='LC1153'>						<span class="c1">// return true if there was no movement so rest of screen can scroll</span></div><div class='line' id='LC1154'>						<span class="k">return</span> <span class="nx">dX</span> <span class="o">==</span> <span class="nx">horizontalDragPosition</span> <span class="o">&amp;&amp;</span> <span class="nx">dY</span> <span class="o">==</span> <span class="nx">verticalDragPosition</span><span class="p">;</span></div><div class='line' id='LC1155'>					<span class="p">}</span></div><div class='line' id='LC1156'>				<span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC1157'>					<span class="s1">&#39;touchend.jsp&#39;</span><span class="p">,</span></div><div class='line' id='LC1158'>					<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC1159'>					<span class="p">{</span></div><div class='line' id='LC1160'>						<span class="nx">moving</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC1161'>						<span class="cm">/*if(moved) {</span></div><div class='line' id='LC1162'><span class="cm">							return false;</span></div><div class='line' id='LC1163'><span class="cm">						}*/</span></div><div class='line' id='LC1164'>					<span class="p">}</span></div><div class='line' id='LC1165'>				<span class="p">).</span><span class="nx">bind</span><span class="p">(</span></div><div class='line' id='LC1166'>					<span class="s1">&#39;click.jsp-touchclick&#39;</span><span class="p">,</span></div><div class='line' id='LC1167'>					<span class="kd">function</span><span class="p">(</span><span class="nx">e</span><span class="p">)</span></div><div class='line' id='LC1168'>					<span class="p">{</span></div><div class='line' id='LC1169'>						<span class="k">if</span><span class="p">(</span><span class="nx">moved</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1170'>							<span class="nx">moved</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC1171'>							<span class="k">return</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC1172'>						<span class="p">}</span></div><div class='line' id='LC1173'>					<span class="p">}</span></div><div class='line' id='LC1174'>				<span class="p">);</span></div><div class='line' id='LC1175'>			<span class="p">}</span></div><div class='line' id='LC1176'><br/></div><div class='line' id='LC1177'>			<span class="kd">function</span> <span class="nx">destroy</span><span class="p">(){</span></div><div class='line' id='LC1178'>				<span class="kd">var</span> <span class="nx">currentY</span> <span class="o">=</span> <span class="nx">contentPositionY</span><span class="p">(),</span></div><div class='line' id='LC1179'>					<span class="nx">currentX</span> <span class="o">=</span> <span class="nx">contentPositionX</span><span class="p">();</span></div><div class='line' id='LC1180'>				<span class="nx">elem</span><span class="p">.</span><span class="nx">removeClass</span><span class="p">(</span><span class="s1">&#39;jspScrollable&#39;</span><span class="p">).</span><span class="nx">unbind</span><span class="p">(</span><span class="s1">&#39;.jsp&#39;</span><span class="p">);</span></div><div class='line' id='LC1181'>				<span class="nx">elem</span><span class="p">.</span><span class="nx">replaceWith</span><span class="p">(</span><span class="nx">originalElement</span><span class="p">.</span><span class="nx">append</span><span class="p">(</span><span class="nx">pane</span><span class="p">.</span><span class="nx">children</span><span class="p">()));</span></div><div class='line' id='LC1182'>				<span class="nx">originalElement</span><span class="p">.</span><span class="nx">scrollTop</span><span class="p">(</span><span class="nx">currentY</span><span class="p">);</span></div><div class='line' id='LC1183'>				<span class="nx">originalElement</span><span class="p">.</span><span class="nx">scrollLeft</span><span class="p">(</span><span class="nx">currentX</span><span class="p">);</span></div><div class='line' id='LC1184'><br/></div><div class='line' id='LC1185'>				<span class="c1">// clear reinitialize timer if active</span></div><div class='line' id='LC1186'>				<span class="k">if</span> <span class="p">(</span><span class="nx">reinitialiseInterval</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1187'>					<span class="nx">clearInterval</span><span class="p">(</span><span class="nx">reinitialiseInterval</span><span class="p">);</span></div><div class='line' id='LC1188'>				<span class="p">}</span></div><div class='line' id='LC1189'>			<span class="p">}</span></div><div class='line' id='LC1190'><br/></div><div class='line' id='LC1191'>			<span class="c1">// Public API</span></div><div class='line' id='LC1192'>			<span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">(</span></div><div class='line' id='LC1193'>				<span class="nx">jsp</span><span class="p">,</span></div><div class='line' id='LC1194'>				<span class="p">{</span></div><div class='line' id='LC1195'>					<span class="c1">// Reinitialises the scroll pane (if it&#39;s internal dimensions have changed since the last time it</span></div><div class='line' id='LC1196'>					<span class="c1">// was initialised). The settings object which is passed in will override any settings from the</span></div><div class='line' id='LC1197'>					<span class="c1">// previous time it was initialised - if you don&#39;t pass any settings then the ones from the previous</span></div><div class='line' id='LC1198'>					<span class="c1">// initialisation will be used.</span></div><div class='line' id='LC1199'>					<span class="nx">reinitialise</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">s</span><span class="p">)</span></div><div class='line' id='LC1200'>					<span class="p">{</span></div><div class='line' id='LC1201'>						<span class="nx">s</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">({},</span> <span class="nx">settings</span><span class="p">,</span> <span class="nx">s</span><span class="p">);</span></div><div class='line' id='LC1202'>						<span class="nx">initialise</span><span class="p">(</span><span class="nx">s</span><span class="p">);</span></div><div class='line' id='LC1203'>					<span class="p">},</span></div><div class='line' id='LC1204'>					<span class="c1">// Scrolls the specified element (a jQuery object, DOM node or jQuery selector string) into view so</span></div><div class='line' id='LC1205'>					<span class="c1">// that it can be seen within the viewport. If stickToTop is true then the element will appear at</span></div><div class='line' id='LC1206'>					<span class="c1">// the top of the viewport, if it is false then the viewport will scroll as little as possible to</span></div><div class='line' id='LC1207'>					<span class="c1">// show the element. You can also specify if you want animation to occur. If you don&#39;t provide this</span></div><div class='line' id='LC1208'>					<span class="c1">// argument then the animateScroll value from the settings object is used instead.</span></div><div class='line' id='LC1209'>					<span class="nx">scrollToElement</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">ele</span><span class="p">,</span> <span class="nx">stickToTop</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1210'>					<span class="p">{</span></div><div class='line' id='LC1211'>						<span class="nx">scrollToElement</span><span class="p">(</span><span class="nx">ele</span><span class="p">,</span> <span class="nx">stickToTop</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1212'>					<span class="p">},</span></div><div class='line' id='LC1213'>					<span class="c1">// Scrolls the pane so that the specified co-ordinates within the content are at the top left</span></div><div class='line' id='LC1214'>					<span class="c1">// of the viewport. animate is optional and if not passed then the value of animateScroll from</span></div><div class='line' id='LC1215'>					<span class="c1">// the settings object this jScrollPane was initialised with is used.</span></div><div class='line' id='LC1216'>					<span class="nx">scrollTo</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">destX</span><span class="p">,</span> <span class="nx">destY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1217'>					<span class="p">{</span></div><div class='line' id='LC1218'>						<span class="nx">scrollToX</span><span class="p">(</span><span class="nx">destX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1219'>						<span class="nx">scrollToY</span><span class="p">(</span><span class="nx">destY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1220'>					<span class="p">},</span></div><div class='line' id='LC1221'>					<span class="c1">// Scrolls the pane so that the specified co-ordinate within the content is at the left of the</span></div><div class='line' id='LC1222'>					<span class="c1">// viewport. animate is optional and if not passed then the value of animateScroll from the settings</span></div><div class='line' id='LC1223'>					<span class="c1">// object this jScrollPane was initialised with is used.</span></div><div class='line' id='LC1224'>					<span class="nx">scrollToX</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">destX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1225'>					<span class="p">{</span></div><div class='line' id='LC1226'>						<span class="nx">scrollToX</span><span class="p">(</span><span class="nx">destX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1227'>					<span class="p">},</span></div><div class='line' id='LC1228'>					<span class="c1">// Scrolls the pane so that the specified co-ordinate within the content is at the top of the</span></div><div class='line' id='LC1229'>					<span class="c1">// viewport. animate is optional and if not passed then the value of animateScroll from the settings</span></div><div class='line' id='LC1230'>					<span class="c1">// object this jScrollPane was initialised with is used.</span></div><div class='line' id='LC1231'>					<span class="nx">scrollToY</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">destY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1232'>					<span class="p">{</span></div><div class='line' id='LC1233'>						<span class="nx">scrollToY</span><span class="p">(</span><span class="nx">destY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1234'>					<span class="p">},</span></div><div class='line' id='LC1235'>					<span class="c1">// Scrolls the pane to the specified percentage of its maximum horizontal scroll position. animate</span></div><div class='line' id='LC1236'>					<span class="c1">// is optional and if not passed then the value of animateScroll from the settings object this</span></div><div class='line' id='LC1237'>					<span class="c1">// jScrollPane was initialised with is used.</span></div><div class='line' id='LC1238'>					<span class="nx">scrollToPercentX</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">destPercentX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1239'>					<span class="p">{</span></div><div class='line' id='LC1240'>						<span class="nx">scrollToX</span><span class="p">(</span><span class="nx">destPercentX</span> <span class="o">*</span> <span class="p">(</span><span class="nx">contentWidth</span> <span class="o">-</span> <span class="nx">paneWidth</span><span class="p">),</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1241'>					<span class="p">},</span></div><div class='line' id='LC1242'>					<span class="c1">// Scrolls the pane to the specified percentage of its maximum vertical scroll position. animate</span></div><div class='line' id='LC1243'>					<span class="c1">// is optional and if not passed then the value of animateScroll from the settings object this</span></div><div class='line' id='LC1244'>					<span class="c1">// jScrollPane was initialised with is used.</span></div><div class='line' id='LC1245'>					<span class="nx">scrollToPercentY</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">destPercentY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1246'>					<span class="p">{</span></div><div class='line' id='LC1247'>						<span class="nx">scrollToY</span><span class="p">(</span><span class="nx">destPercentY</span> <span class="o">*</span> <span class="p">(</span><span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">),</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1248'>					<span class="p">},</span></div><div class='line' id='LC1249'>					<span class="c1">// Scrolls the pane by the specified amount of pixels. animate is optional and if not passed then</span></div><div class='line' id='LC1250'>					<span class="c1">// the value of animateScroll from the settings object this jScrollPane was initialised with is used.</span></div><div class='line' id='LC1251'>					<span class="nx">scrollBy</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">deltaX</span><span class="p">,</span> <span class="nx">deltaY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1252'>					<span class="p">{</span></div><div class='line' id='LC1253'>						<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByX</span><span class="p">(</span><span class="nx">deltaX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1254'>						<span class="nx">jsp</span><span class="p">.</span><span class="nx">scrollByY</span><span class="p">(</span><span class="nx">deltaY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1255'>					<span class="p">},</span></div><div class='line' id='LC1256'>					<span class="c1">// Scrolls the pane by the specified amount of pixels. animate is optional and if not passed then</span></div><div class='line' id='LC1257'>					<span class="c1">// the value of animateScroll from the settings object this jScrollPane was initialised with is used.</span></div><div class='line' id='LC1258'>					<span class="nx">scrollByX</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">deltaX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1259'>					<span class="p">{</span></div><div class='line' id='LC1260'>						<span class="kd">var</span> <span class="nx">destX</span> <span class="o">=</span> <span class="nx">contentPositionX</span><span class="p">()</span> <span class="o">+</span> <span class="nb">Math</span><span class="p">[</span><span class="nx">deltaX</span><span class="o">&lt;</span><span class="mi">0</span> <span class="o">?</span> <span class="s1">&#39;floor&#39;</span> <span class="o">:</span> <span class="s1">&#39;ceil&#39;</span><span class="p">](</span><span class="nx">deltaX</span><span class="p">),</span></div><div class='line' id='LC1261'>							<span class="nx">percentScrolled</span> <span class="o">=</span> <span class="nx">destX</span> <span class="o">/</span> <span class="p">(</span><span class="nx">contentWidth</span> <span class="o">-</span> <span class="nx">paneWidth</span><span class="p">);</span></div><div class='line' id='LC1262'>						<span class="nx">positionDragX</span><span class="p">(</span><span class="nx">percentScrolled</span> <span class="o">*</span> <span class="nx">dragMaxX</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1263'>					<span class="p">},</span></div><div class='line' id='LC1264'>					<span class="c1">// Scrolls the pane by the specified amount of pixels. animate is optional and if not passed then</span></div><div class='line' id='LC1265'>					<span class="c1">// the value of animateScroll from the settings object this jScrollPane was initialised with is used.</span></div><div class='line' id='LC1266'>					<span class="nx">scrollByY</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">deltaY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1267'>					<span class="p">{</span></div><div class='line' id='LC1268'>						<span class="kd">var</span> <span class="nx">destY</span> <span class="o">=</span> <span class="nx">contentPositionY</span><span class="p">()</span> <span class="o">+</span> <span class="nb">Math</span><span class="p">[</span><span class="nx">deltaY</span><span class="o">&lt;</span><span class="mi">0</span> <span class="o">?</span> <span class="s1">&#39;floor&#39;</span> <span class="o">:</span> <span class="s1">&#39;ceil&#39;</span><span class="p">](</span><span class="nx">deltaY</span><span class="p">),</span></div><div class='line' id='LC1269'>							<span class="nx">percentScrolled</span> <span class="o">=</span> <span class="nx">destY</span> <span class="o">/</span> <span class="p">(</span><span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">);</span></div><div class='line' id='LC1270'>						<span class="nx">positionDragY</span><span class="p">(</span><span class="nx">percentScrolled</span> <span class="o">*</span> <span class="nx">dragMaxY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1271'>					<span class="p">},</span></div><div class='line' id='LC1272'>					<span class="c1">// Positions the horizontal drag at the specified x position (and updates the viewport to reflect</span></div><div class='line' id='LC1273'>					<span class="c1">// this). animate is optional and if not passed then the value of animateScroll from the settings</span></div><div class='line' id='LC1274'>					<span class="c1">// object this jScrollPane was initialised with is used.</span></div><div class='line' id='LC1275'>					<span class="nx">positionDragX</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">x</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1276'>					<span class="p">{</span></div><div class='line' id='LC1277'>						<span class="nx">positionDragX</span><span class="p">(</span><span class="nx">x</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1278'>					<span class="p">},</span></div><div class='line' id='LC1279'>					<span class="c1">// Positions the vertical drag at the specified y position (and updates the viewport to reflect</span></div><div class='line' id='LC1280'>					<span class="c1">// this). animate is optional and if not passed then the value of animateScroll from the settings</span></div><div class='line' id='LC1281'>					<span class="c1">// object this jScrollPane was initialised with is used.</span></div><div class='line' id='LC1282'>					<span class="nx">positionDragY</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">y</span><span class="p">,</span> <span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1283'>					<span class="p">{</span></div><div class='line' id='LC1284'>						<span class="nx">positionDragY</span><span class="p">(</span><span class="nx">y</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1285'>					<span class="p">},</span></div><div class='line' id='LC1286'>					<span class="c1">// This method is called when jScrollPane is trying to animate to a new position. You can override</span></div><div class='line' id='LC1287'>					<span class="c1">// it if you want to provide advanced animation functionality. It is passed the following arguments:</span></div><div class='line' id='LC1288'>					<span class="c1">//  * ele          - the element whose position is being animated</span></div><div class='line' id='LC1289'>					<span class="c1">//  * prop         - the property that is being animated</span></div><div class='line' id='LC1290'>					<span class="c1">//  * value        - the value it&#39;s being animated to</span></div><div class='line' id='LC1291'>					<span class="c1">//  * stepCallback - a function that you must execute each time you update the value of the property</span></div><div class='line' id='LC1292'>					<span class="c1">// You can use the default implementation (below) as a starting point for your own implementation.</span></div><div class='line' id='LC1293'>					<span class="nx">animate</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">ele</span><span class="p">,</span> <span class="nx">prop</span><span class="p">,</span> <span class="nx">value</span><span class="p">,</span> <span class="nx">stepCallback</span><span class="p">)</span></div><div class='line' id='LC1294'>					<span class="p">{</span></div><div class='line' id='LC1295'>						<span class="kd">var</span> <span class="nx">params</span> <span class="o">=</span> <span class="p">{};</span></div><div class='line' id='LC1296'>						<span class="nx">params</span><span class="p">[</span><span class="nx">prop</span><span class="p">]</span> <span class="o">=</span> <span class="nx">value</span><span class="p">;</span></div><div class='line' id='LC1297'>						<span class="nx">ele</span><span class="p">.</span><span class="nx">animate</span><span class="p">(</span></div><div class='line' id='LC1298'>							<span class="nx">params</span><span class="p">,</span></div><div class='line' id='LC1299'>							<span class="p">{</span></div><div class='line' id='LC1300'>								<span class="s1">&#39;duration&#39;</span>	<span class="o">:</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">animateDuration</span><span class="p">,</span></div><div class='line' id='LC1301'>								<span class="s1">&#39;easing&#39;</span>	<span class="o">:</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">animateEase</span><span class="p">,</span></div><div class='line' id='LC1302'>								<span class="s1">&#39;queue&#39;</span>		<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1303'>								<span class="s1">&#39;step&#39;</span>		<span class="o">:</span> <span class="nx">stepCallback</span></div><div class='line' id='LC1304'>							<span class="p">}</span></div><div class='line' id='LC1305'>						<span class="p">);</span></div><div class='line' id='LC1306'>					<span class="p">},</span></div><div class='line' id='LC1307'>					<span class="c1">// Returns the current x position of the viewport with regards to the content pane.</span></div><div class='line' id='LC1308'>					<span class="nx">getContentPositionX</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1309'>					<span class="p">{</span></div><div class='line' id='LC1310'>						<span class="k">return</span> <span class="nx">contentPositionX</span><span class="p">();</span></div><div class='line' id='LC1311'>					<span class="p">},</span></div><div class='line' id='LC1312'>					<span class="c1">// Returns the current y position of the viewport with regards to the content pane.</span></div><div class='line' id='LC1313'>					<span class="nx">getContentPositionY</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1314'>					<span class="p">{</span></div><div class='line' id='LC1315'>						<span class="k">return</span> <span class="nx">contentPositionY</span><span class="p">();</span></div><div class='line' id='LC1316'>					<span class="p">},</span></div><div class='line' id='LC1317'>					<span class="c1">// Returns the width of the content within the scroll pane.</span></div><div class='line' id='LC1318'>					<span class="nx">getContentWidth</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1319'>					<span class="p">{</span></div><div class='line' id='LC1320'>						<span class="k">return</span> <span class="nx">contentWidth</span><span class="p">;</span></div><div class='line' id='LC1321'>					<span class="p">},</span></div><div class='line' id='LC1322'>					<span class="c1">// Returns the height of the content within the scroll pane.</span></div><div class='line' id='LC1323'>					<span class="nx">getContentHeight</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1324'>					<span class="p">{</span></div><div class='line' id='LC1325'>						<span class="k">return</span> <span class="nx">contentHeight</span><span class="p">;</span></div><div class='line' id='LC1326'>					<span class="p">},</span></div><div class='line' id='LC1327'>					<span class="c1">// Returns the horizontal position of the viewport within the pane content.</span></div><div class='line' id='LC1328'>					<span class="nx">getPercentScrolledX</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1329'>					<span class="p">{</span></div><div class='line' id='LC1330'>						<span class="k">return</span> <span class="nx">contentPositionX</span><span class="p">()</span> <span class="o">/</span> <span class="p">(</span><span class="nx">contentWidth</span> <span class="o">-</span> <span class="nx">paneWidth</span><span class="p">);</span></div><div class='line' id='LC1331'>					<span class="p">},</span></div><div class='line' id='LC1332'>					<span class="c1">// Returns the vertical position of the viewport within the pane content.</span></div><div class='line' id='LC1333'>					<span class="nx">getPercentScrolledY</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1334'>					<span class="p">{</span></div><div class='line' id='LC1335'>						<span class="k">return</span> <span class="nx">contentPositionY</span><span class="p">()</span> <span class="o">/</span> <span class="p">(</span><span class="nx">contentHeight</span> <span class="o">-</span> <span class="nx">paneHeight</span><span class="p">);</span></div><div class='line' id='LC1336'>					<span class="p">},</span></div><div class='line' id='LC1337'>					<span class="c1">// Returns whether or not this scrollpane has a horizontal scrollbar.</span></div><div class='line' id='LC1338'>					<span class="nx">getIsScrollableH</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1339'>					<span class="p">{</span></div><div class='line' id='LC1340'>						<span class="k">return</span> <span class="nx">isScrollableH</span><span class="p">;</span></div><div class='line' id='LC1341'>					<span class="p">},</span></div><div class='line' id='LC1342'>					<span class="c1">// Returns whether or not this scrollpane has a vertical scrollbar.</span></div><div class='line' id='LC1343'>					<span class="nx">getIsScrollableV</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1344'>					<span class="p">{</span></div><div class='line' id='LC1345'>						<span class="k">return</span> <span class="nx">isScrollableV</span><span class="p">;</span></div><div class='line' id='LC1346'>					<span class="p">},</span></div><div class='line' id='LC1347'>					<span class="c1">// Gets a reference to the content pane. It is important that you use this method if you want to</span></div><div class='line' id='LC1348'>					<span class="c1">// edit the content of your jScrollPane as if you access the element directly then you may have some</span></div><div class='line' id='LC1349'>					<span class="c1">// problems (as your original element has had additional elements for the scrollbars etc added into</span></div><div class='line' id='LC1350'>					<span class="c1">// it).</span></div><div class='line' id='LC1351'>					<span class="nx">getContentPane</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1352'>					<span class="p">{</span></div><div class='line' id='LC1353'>						<span class="k">return</span> <span class="nx">pane</span><span class="p">;</span></div><div class='line' id='LC1354'>					<span class="p">},</span></div><div class='line' id='LC1355'>					<span class="c1">// Scrolls this jScrollPane down as far as it can currently scroll. If animate isn&#39;t passed then the</span></div><div class='line' id='LC1356'>					<span class="c1">// animateScroll value from settings is used instead.</span></div><div class='line' id='LC1357'>					<span class="nx">scrollToBottom</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">animate</span><span class="p">)</span></div><div class='line' id='LC1358'>					<span class="p">{</span></div><div class='line' id='LC1359'>						<span class="nx">positionDragY</span><span class="p">(</span><span class="nx">dragMaxY</span><span class="p">,</span> <span class="nx">animate</span><span class="p">);</span></div><div class='line' id='LC1360'>					<span class="p">},</span></div><div class='line' id='LC1361'>					<span class="c1">// Hijacks the links on the page which link to content inside the scrollpane. If you have changed</span></div><div class='line' id='LC1362'>					<span class="c1">// the content of your page (e.g. via AJAX) and want to make sure any new anchor links to the</span></div><div class='line' id='LC1363'>					<span class="c1">// contents of your scroll pane will work then call this function.</span></div><div class='line' id='LC1364'>					<span class="nx">hijackInternalLinks</span><span class="o">:</span> <span class="nx">$</span><span class="p">.</span><span class="nx">noop</span><span class="p">,</span></div><div class='line' id='LC1365'>					<span class="c1">// Removes the jScrollPane and returns the page to the state it was in before jScrollPane was</span></div><div class='line' id='LC1366'>					<span class="c1">// initialised.</span></div><div class='line' id='LC1367'>					<span class="nx">destroy</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1368'>					<span class="p">{</span></div><div class='line' id='LC1369'>							<span class="nx">destroy</span><span class="p">();</span></div><div class='line' id='LC1370'>					<span class="p">}</span></div><div class='line' id='LC1371'>				<span class="p">}</span></div><div class='line' id='LC1372'>			<span class="p">);</span></div><div class='line' id='LC1373'><br/></div><div class='line' id='LC1374'>			<span class="nx">initialise</span><span class="p">(</span><span class="nx">s</span><span class="p">);</span></div><div class='line' id='LC1375'>		<span class="p">}</span></div><div class='line' id='LC1376'><br/></div><div class='line' id='LC1377'>		<span class="c1">// Pluginifying code...</span></div><div class='line' id='LC1378'>		<span class="nx">settings</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">({},</span> <span class="nx">$</span><span class="p">.</span><span class="nx">fn</span><span class="p">.</span><span class="nx">jScrollPane</span><span class="p">.</span><span class="nx">defaults</span><span class="p">,</span> <span class="nx">settings</span><span class="p">);</span></div><div class='line' id='LC1379'><br/></div><div class='line' id='LC1380'>		<span class="c1">// Apply default speed</span></div><div class='line' id='LC1381'>		<span class="nx">$</span><span class="p">.</span><span class="nx">each</span><span class="p">([</span><span class="s1">&#39;mouseWheelSpeed&#39;</span><span class="p">,</span> <span class="s1">&#39;arrowButtonSpeed&#39;</span><span class="p">,</span> <span class="s1">&#39;trackClickSpeed&#39;</span><span class="p">,</span> <span class="s1">&#39;keyboardSpeed&#39;</span><span class="p">],</span> <span class="kd">function</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC1382'>			<span class="nx">settings</span><span class="p">[</span><span class="k">this</span><span class="p">]</span> <span class="o">=</span> <span class="nx">settings</span><span class="p">[</span><span class="k">this</span><span class="p">]</span> <span class="o">||</span> <span class="nx">settings</span><span class="p">.</span><span class="nx">speed</span><span class="p">;</span></div><div class='line' id='LC1383'>		<span class="p">});</span></div><div class='line' id='LC1384'><br/></div><div class='line' id='LC1385'>		<span class="k">return</span> <span class="k">this</span><span class="p">.</span><span class="nx">each</span><span class="p">(</span></div><div class='line' id='LC1386'>			<span class="kd">function</span><span class="p">()</span></div><div class='line' id='LC1387'>			<span class="p">{</span></div><div class='line' id='LC1388'>				<span class="kd">var</span> <span class="nx">elem</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">),</span> <span class="nx">jspApi</span> <span class="o">=</span> <span class="nx">elem</span><span class="p">.</span><span class="nx">data</span><span class="p">(</span><span class="s1">&#39;jsp&#39;</span><span class="p">);</span></div><div class='line' id='LC1389'>				<span class="k">if</span> <span class="p">(</span><span class="nx">jspApi</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1390'>					<span class="nx">jspApi</span><span class="p">.</span><span class="nx">reinitialise</span><span class="p">(</span><span class="nx">settings</span><span class="p">);</span></div><div class='line' id='LC1391'>				<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC1392'>					<span class="nx">$</span><span class="p">(</span><span class="s2">&quot;script&quot;</span><span class="p">,</span><span class="nx">elem</span><span class="p">).</span><span class="nx">filter</span><span class="p">(</span><span class="s1">&#39;[type=&quot;text/javascript&quot;],:not([type])&#39;</span><span class="p">).</span><span class="nx">remove</span><span class="p">();</span></div><div class='line' id='LC1393'>					<span class="nx">jspApi</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">JScrollPane</span><span class="p">(</span><span class="nx">elem</span><span class="p">,</span> <span class="nx">settings</span><span class="p">);</span></div><div class='line' id='LC1394'>					<span class="nx">elem</span><span class="p">.</span><span class="nx">data</span><span class="p">(</span><span class="s1">&#39;jsp&#39;</span><span class="p">,</span> <span class="nx">jspApi</span><span class="p">);</span></div><div class='line' id='LC1395'>				<span class="p">}</span></div><div class='line' id='LC1396'>			<span class="p">}</span></div><div class='line' id='LC1397'>		<span class="p">);</span></div><div class='line' id='LC1398'>	<span class="p">};</span></div><div class='line' id='LC1399'><br/></div><div class='line' id='LC1400'>	<span class="nx">$</span><span class="p">.</span><span class="nx">fn</span><span class="p">.</span><span class="nx">jScrollPane</span><span class="p">.</span><span class="nx">defaults</span> <span class="o">=</span> <span class="p">{</span></div><div class='line' id='LC1401'>		<span class="nx">showArrows</span>					<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1402'>		<span class="nx">maintainPosition</span>			<span class="o">:</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC1403'>		<span class="nx">stickToBottom</span>				<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1404'>		<span class="nx">stickToRight</span>				<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1405'>		<span class="nx">clickOnTrack</span>				<span class="o">:</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC1406'>		<span class="nx">autoReinitialise</span>			<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1407'>		<span class="nx">autoReinitialiseDelay</span>		<span class="o">:</span> <span class="mi">500</span><span class="p">,</span></div><div class='line' id='LC1408'>		<span class="nx">verticalDragMinHeight</span>		<span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC1409'>		<span class="nx">verticalDragMaxHeight</span>		<span class="o">:</span> <span class="mi">99999</span><span class="p">,</span></div><div class='line' id='LC1410'>		<span class="nx">horizontalDragMinWidth</span>		<span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC1411'>		<span class="nx">horizontalDragMaxWidth</span>		<span class="o">:</span> <span class="mi">99999</span><span class="p">,</span></div><div class='line' id='LC1412'>		<span class="nx">contentWidth</span>				<span class="o">:</span> <span class="kc">undefined</span><span class="p">,</span></div><div class='line' id='LC1413'>		<span class="nx">animateScroll</span>				<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1414'>		<span class="nx">animateDuration</span>				<span class="o">:</span> <span class="mi">300</span><span class="p">,</span></div><div class='line' id='LC1415'>		<span class="nx">animateEase</span>					<span class="o">:</span> <span class="s1">&#39;linear&#39;</span><span class="p">,</span></div><div class='line' id='LC1416'>		<span class="nx">hijackInternalLinks</span>			<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1417'>		<span class="nx">verticalGutter</span>				<span class="o">:</span> <span class="mi">4</span><span class="p">,</span></div><div class='line' id='LC1418'>		<span class="nx">horizontalGutter</span>			<span class="o">:</span> <span class="mi">4</span><span class="p">,</span></div><div class='line' id='LC1419'>		<span class="nx">mouseWheelSpeed</span>				<span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC1420'>		<span class="nx">arrowButtonSpeed</span>			<span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC1421'>		<span class="nx">arrowRepeatFreq</span>				<span class="o">:</span> <span class="mi">50</span><span class="p">,</span></div><div class='line' id='LC1422'>		<span class="nx">arrowScrollOnHover</span>			<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1423'>		<span class="nx">trackClickSpeed</span>				<span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC1424'>		<span class="nx">trackClickRepeatFreq</span>		<span class="o">:</span> <span class="mi">70</span><span class="p">,</span></div><div class='line' id='LC1425'>		<span class="nx">verticalArrowPositions</span>		<span class="o">:</span> <span class="s1">&#39;split&#39;</span><span class="p">,</span></div><div class='line' id='LC1426'>		<span class="nx">horizontalArrowPositions</span>	<span class="o">:</span> <span class="s1">&#39;split&#39;</span><span class="p">,</span></div><div class='line' id='LC1427'>		<span class="nx">enableKeyboardNavigation</span>	<span class="o">:</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC1428'>		<span class="nx">hideFocus</span>					<span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC1429'>		<span class="nx">keyboardSpeed</span>				<span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC1430'>		<span class="nx">initialDelay</span>                <span class="o">:</span> <span class="mi">300</span><span class="p">,</span>        <span class="c1">// Delay before starting repeating</span></div><div class='line' id='LC1431'>		<span class="nx">speed</span>						<span class="o">:</span> <span class="mi">30</span><span class="p">,</span>		<span class="c1">// Default speed when others falsey</span></div><div class='line' id='LC1432'>		<span class="nx">scrollPagePercent</span>			<span class="o">:</span> <span class="p">.</span><span class="mi">8</span>		<span class="c1">// Percent of visible area scrolled when pageUp/Down or track area pressed</span></div><div class='line' id='LC1433'>	<span class="p">};</span></div><div class='line' id='LC1434'><br/></div><div class='line' id='LC1435'><span class="p">})(</span><span class="nx">jQuery</span><span class="p">,</span><span class="k">this</span><span class="p">);</span></div><div class='line' id='LC1436'><br/></div></pre></div>
          </td>
        </tr>
      </table>
  </div>

          </div>
        </div>

        <a href="#jump-to-line" rel="facebox" data-hotkey="l" class="js-jump-to-line" style="display:none">Jump to Line</a>
        <div id="jump-to-line" style="display:none">
          <h2>Jump to Line</h2>
          <form accept-charset="UTF-8" class="js-jump-to-line-form">
            <input class="textfield js-jump-to-line-field" type="text">
            <div class="full-button">
              <button type="submit" class="button">Go</button>
            </div>
          </form>
        </div>

      </div>
    </div>
</div>

<div id="js-frame-loading-template" class="frame frame-loading large-loading-area" style="display:none;">
  <img class="js-frame-loading-spinner" src="https://a248.e.akamai.net/assets.github.com/images/spinners/octocat-spinner-128.gif?1360648847" height="64" width="64">
</div>


        </div>
      </div>
      <div class="context-overlay"></div>
    </div>

      <div id="footer-push"></div><!-- hack for sticky footer -->
    </div><!-- end of wrapper - hack for sticky footer -->

      <!-- footer -->
      <div id="footer">
  <div class="container clearfix">

      <dl class="footer_nav">
        <dt>GitHub</dt>
        <dd><a href="https://github.com/about">About us</a></dd>
        <dd><a href="https://github.com/blog">Blog</a></dd>
        <dd><a href="https://github.com/contact">Contact &amp; support</a></dd>
        <dd><a href="http://enterprise.github.com/">GitHub Enterprise</a></dd>
        <dd><a href="http://status.github.com/">Site status</a></dd>
      </dl>

      <dl class="footer_nav">
        <dt>Applications</dt>
        <dd><a href="http://mac.github.com/">GitHub for Mac</a></dd>
        <dd><a href="http://windows.github.com/">GitHub for Windows</a></dd>
        <dd><a href="http://eclipse.github.com/">GitHub for Eclipse</a></dd>
        <dd><a href="http://mobile.github.com/">GitHub mobile apps</a></dd>
      </dl>

      <dl class="footer_nav">
        <dt>Services</dt>
        <dd><a href="http://get.gaug.es/">Gauges: Web analytics</a></dd>
        <dd><a href="http://speakerdeck.com">Speaker Deck: Presentations</a></dd>
        <dd><a href="https://gist.github.com">Gist: Code snippets</a></dd>
        <dd><a href="http://jobs.github.com/">Job board</a></dd>
      </dl>

      <dl class="footer_nav">
        <dt>Documentation</dt>
        <dd><a href="http://help.github.com/">GitHub Help</a></dd>
        <dd><a href="http://developer.github.com/">Developer API</a></dd>
        <dd><a href="http://github.github.com/github-flavored-markdown/">GitHub Flavored Markdown</a></dd>
        <dd><a href="http://pages.github.com/">GitHub Pages</a></dd>
      </dl>

      <dl class="footer_nav">
        <dt>More</dt>
        <dd><a href="http://training.github.com/">Training</a></dd>
        <dd><a href="https://github.com/edu">Students &amp; teachers</a></dd>
        <dd><a href="http://shop.github.com">The Shop</a></dd>
        <dd><a href="/plans">Plans &amp; pricing</a></dd>
        <dd><a href="http://octodex.github.com/">The Octodex</a></dd>
      </dl>

      <hr class="footer-divider">


    <p class="right">&copy; 2013 <span title="0.05461s from fe4.rs.github.com">GitHub</span>, Inc. All rights reserved.</p>
    <a class="left" href="https://github.com/">
      <span class="mega-icon mega-icon-invertocat"></span>
    </a>
    <ul id="legal">
        <li><a href="https://github.com/site/terms">Terms of Service</a></li>
        <li><a href="https://github.com/site/privacy">Privacy</a></li>
        <li><a href="https://github.com/security">Security</a></li>
    </ul>

  </div><!-- /.container -->

</div><!-- /.#footer -->


    <div class="fullscreen-overlay js-fullscreen-overlay" id="fullscreen_overlay">
  <div class="fullscreen-container js-fullscreen-container">
    <div class="textarea-wrap">
      <textarea name="fullscreen-contents" id="fullscreen-contents" class="js-fullscreen-contents" placeholder="" data-suggester="fullscreen_suggester"></textarea>
          <div class="suggester-container">
              <div class="suggester fullscreen-suggester js-navigation-container" id="fullscreen_suggester"
                 data-url="/vitch/jScrollPane/suggestions/commit">
              </div>
          </div>
    </div>
  </div>
  <div class="fullscreen-sidebar">
    <a href="#" class="exit-fullscreen js-exit-fullscreen tooltipped leftwards" title="Exit Zen Mode">
      <span class="mega-icon mega-icon-normalscreen"></span>
    </a>
    <a href="#" class="theme-switcher js-theme-switcher tooltipped leftwards"
      title="Switch themes">
      <span class="mini-icon mini-icon-brightness"></span>
    </a>
  </div>
</div>



    <div id="ajax-error-message" class="flash flash-error">
      <span class="mini-icon mini-icon-exclamation"></span>
      Something went wrong with that request. Please try again.
      <a href="#" class="mini-icon mini-icon-remove-close ajax-error-dismiss"></a>
    </div>

    
    
    <span id='server_response_time' data-time='0.05497' data-host='fe4'></span>
    
  </body>
</html>

