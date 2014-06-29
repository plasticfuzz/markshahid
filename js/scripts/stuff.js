/*   
Theme Name: Stuff
*/

//------------------------------------------------------------------------------

function strRepeat(s, n) {
  var a = [];
  while (a.length < n) {
    a.push(s);
  }
  return a.join('');
}

//------------------------------------------------------------------------------

function initBox(params) {
  box_config = jQuery.extend({
    scrollWidthPreload: 50, // number of pixels from the page's end to start content loading
    requestURL: '',         // URL of getting content script
    requestType: 'post',    // method of calling (POST or GET)
    params: {},             // additional parameters given while script calling (e.g. {param1: value1, param2: value2})
    offset: 0,              // starting element ID offset
    limit: 100              // maximum of loaded elements (posts, portfolio items)
  }, params);
}

//------------------------------------------------------------------------------

function initConfig(config) {
  return jQuery.extend({
    middlePoint: 310,
    portfolioGalleryChangeEffect: 'fade',
    portfolioGalleryChangeSpeed: 150,
    portfolioGalleryNavOnHover: false,
    columnSupport: true,
    columnPageChangeSpeed: 'normal',
    mouseWheelSupport: true            
  }, config);
}

// -----------------------------------------------------------------------------

jQuery(document).ready(function() {
  
  // Config
  stuff_config = initConfig(typeof stuff_config != 'undefined' ? stuff_config : []);

  // Browsers support
  ie = jQuery.browser.msie ? parseInt(jQuery.browser.version) : 256;

  // Window
  window_height = jQuery(window).height();

  // Variables
  is_box_loading = false;
  
  // Browser notification
  if (ie <= 6) {
    jQuery('.browser-notification .close').click(function() {
      jQuery(this).parent().hide();
    });
    jQuery(window).scroll(function() {
      jQuery('.browser-notification').css('left', jQuery(window).scrollLeft()+'px');
    });
    jQuery('.browser-notification').show();
  }
  
  // Scheme switcher
  jQuery('#scheme-switcher .select').click(function() {
    var ss = jQuery('#scheme-switcher');
    if (ss.is(':animated'))
      return;
    else if (ss.hasClass('opened'))
      ss.animate({top: -120}, 'fast', function() { jQuery(this).removeClass('opened'); });
    else
      ss.animate({top: 0}, 'fast', function() { jQuery(this).addClass('opened'); });
  });
  
  // Social media
  jQuery('#social-media a').each(function() {
    jQuery(this)
      .css('background-image', 'url('+jQuery('img', this).attr('src')+')')
      .hover(function() {
        if (ie >= 9) jQuery('img', this).stop(true).fadeTo('fast', 1);
        else         jQuery('img', this).css('top', '0');
      }, function() {
        if (ie >= 9) jQuery('img', this).stop(true).fadeTo('fast', 0);
        else    jQuery('img', this).css('top', '32px');
      });
    if (ie >= 9) jQuery('img', this).fadeTo(0, 0);
    else         jQuery('img', this).css('top', '32px');
  });
  
  // Menu
  var menu_mask = jQuery('#menu > .mask');
  // var menu_slices_count = menu_mask.width();
  var menu_slices = '<div style="opacity: 1;"></div>';
  // for (var i = 0; i < menu_slices_count; i++) {
  //   var opacity = 1-(i/menu_slices_count);
  //   var style = ie >= 9 ? 'opacity: '+opacity+';' : 'filter: alpha(opacity='+(opacity*100)+');';
  //   menu_slices.push('<div style="'+style+'"></div>');
  // }
  menu_mask.html(menu_slices);
  
  // Search
  if (ie <= 8) jQuery('#nav-menu li.search div').css('background-color', jQuery('body').css('background-color'));
  jQuery('#nav-menu li.search > a').click(function() {
    var search_div = jQuery(this).parent().find('div');
    if ( ! search_div.is(':animated'))
      if (search_div.is(':visible'))
        search_div.animate({opacity: 0, top: 19}, 'fast', function() { jQuery(this).hide(); });
      else
        search_div.fadeTo(0, 0).animate({opacity: 1, top: 39}, 'fast');
  });

  // Content
  function resizeContentWidth() {
    var box = jQuery('.box');
    jQuery('#content').css('width', box.length*(box.width()-10)+10);
  }
  resizeContentWidth();

  // Boxes
  function loadBox() {
    if (is_box_loading) return;
    is_box_loading = true;
    jQuery('#loader').stop(true).fadeIn('normal');
    jQuery.ajax({
      type: box_config.requestType.toUpperCase(),
      url: box_config.requestURL,
      data: jQuery.extend({id: box_config.offset+jQuery('.box').length}, box_config.params),
      success: function(data) {   
        if (jQuery.trim(data)) {
          var box = jQuery('.box');
          var new_box = jQuery(data).filter('.box').appendTo('#content');   
          var over_limit = box.length+new_box.length - box_config.limit;
          if (over_limit > 0) {
            box_config.offset += over_limit;
            box.slice(0, over_limit).remove();
            jQuery(window).scrollLeft(Math.max(jQuery(window).scrollLeft() - new_box.length*(new_box.width()-10), 0));
          }
          Cufon.refresh();
          resizeContentWidth();
          prepareBox();
          is_box_loading = false;
          preloadBox();
        }
        jQuery('#loader').stop(true).fadeOut('normal');
      }
    });
  }
  function preloadBox() {
    if (jQuery(window).width()+jQuery(window).scrollLeft() >= jQuery(document).width()-box_config.scrollWidthPreload) {
      loadBox();
    }
  }
  function prepareBox() {
    var box = jQuery('.box:not(.ready)');
    if (box.length == 0) return;
    box.addClass('ready').filter('.high').find('.container').css('height', (window_height-20)+'px');
    if (ie >= 8) {
      box.filter(':not(.wide, .high):not(:has(.mask))').find('.excerpt').each(function() {
        var top = jQuery(this).offset().top;
        if (top+jQuery(this).height()+58 > window_height)
          jQuery(this)
            .css('max-height', Math.max(window_height-top-58, 50)+'px')
            .append('<div class="mask">&hellip;</div>');
      }); 
    }
    box.find('.thumbnail.gallery:has(img):not(.nivoSlider)').each(function() {
      if (jQuery(this).parent().parent().hasClass('wide')) {
        if ((jQuery(this).length > 0) && (jQuery('img', this).length > 1))
          jQuery(this).nivoSlider({
            effect: stuff_config.portfolioGalleryChangeEffect,
            animSpeed: stuff_config.portfolioGalleryChangeSpeed,
            directionNavHide: stuff_config.portfolioGalleryNavOnHover,
            controlNav: false,
            keyboardNav: false,
            manualAdvance: true
          });
      }
      else
        jQuery('a', this).fancybox({
          centerOnScroll: true,
          titleShow: false
        });
    });
  }
  prepareBox();
  if (typeof box_config != 'undefined') {
    jQuery(window).scroll(preloadBox).resize(preloadBox);
    preloadBox();
  }

  // Comments
  var comments = jQuery('#comments');
  if (comments.length > 0) {
    comments.find('.comment:not(:has(.avatar))').find('.content').css('min-height', '60px');
    comments.find('.comment').hover(function() {
      jQuery('.tools', this).show();
    }, function() {
      jQuery('.tools', this).hide();
    });
    if (stuff_config.columnSupport) {  
      var column_margin = 20;
      var column_width = comments.find('.list:first').width();
      var column_height = Math.max(jQuery('.box.high:first').height() - comments.offset().top*2, jQuery('.comment-form:first').height()+30);
      comments.find('.comment .content').css('max-height', column_height-40);
      comments.find('li').addClass('dontsplit');
      comments
        .css('width', column_width*2+'px')
        .css('height', column_height)
        .columnize({width: column_width, height: column_height, buildOnce: true})
        .css('width', (comments.find('.column:not(:empty)').length*(column_width+column_margin)-column_margin)+'px');
    }
  }
  
  // Contact Form 7
  jQuery('.box .wpcf7-form-control-wrap').replaceWith(function() {
    return jQuery('*', this);
  });
  
  // Form
  jQuery('.box p:not(.input):has(> input[type="text"]), .box div:not(.input):has(> input[type="text"]), .box p:not(.input):has(> input[type="password"]), .box div:not(.input):has(> input[type="password"])').addClass('input');
  jQuery('.box p:not(.textarea):has(> textarea), .box div:not(.textarea):has(> textarea)').addClass('textarea');
  jQuery('.box p:not(.submit):has(> input[type="submit"]), .box div:not(.submit):has(> input[type="submit"])').replaceWith(function() {
    var title = jQuery('input', this).val();
    return '<div class="submit">'+title+'<a title="'+title+'"></a></div>';
  });
  jQuery('form .submit > a').click(function() {
    jQuery(this).parentsUntil('form').last().parent().submit();
  });

  // Contact form
  jQuery('form.contact').submit(function() {
    if (jQuery('.submit', this).hasClass('disabled')) return false;
    if (ie >= 9) jQuery('.submit', this).fadeTo('normal', 0.5);
    jQuery('.loader', this).fadeIn('normal');
    jQuery('.status', this).text('');
    jQuery('.submit', this).addClass('disabled');
    jQuery.post(jQuery(this).attr('action'), jQuery(this).serialize(), function(data) {
      form = jQuery('form.contact');
      if (data.result) form.find('input[type!=hidden], textarea').val('');
      if (ie >= 9) form.find('.submit').fadeTo('normal', 1);
      form.find('.loader').fadeOut('normal');
      form.find('.status').text(data.message);
      form.find('.submit').removeClass('disabled');
    }, 'json');
    return false;
  });

  // Mouse wheel
  if (stuff_config.mouseWheelSupport) {
    function mouseWheel(event) {
      var delta = 0;
      if ( ! event) event = window.event;
      if (event.wheelDelta)
        delta = event.wheelDelta / 120;
      else if (event.detail)
        delta = -event.detail/3;
      if (delta)
        jQuery(window).scrollLeft(jQuery(window).scrollLeft()-Math.round(delta*100));
    }
    if (window.addEventListener)
      window.addEventListener('DOMMouseScroll', mouseWheel, false);
    window.onmousewheel = document.onmousewheel = mouseWheel;
  }
  
  // Cufon font replacement
  jQuery('body').addClass('cufon');
  cufon_replace = jQuery.merge(cufon_replace, [
    {selector: '#scheme-switcher .select, #nav-menu li, h1, h2, h3, h4, h5, h6, form .input', options: {hover: true}}
  ]);
  for (var i in cufon_replace) {
    Cufon.replace(cufon_replace[i].selector, cufon_replace[i].options);
  }

  // Page columns
  var box = jQuery('.box.high:first');
  var columns = box.find('.columns');
  if (stuff_config.columnSupport && (columns.length > 0)) { 
    // Parameters
    var box_nav_page = box.find('.nav-page:first');
    var box_content = box.find('.content:first');   
    var column_count = box.hasClass('wide') ? (columns.hasClass('three') ? 3 : (columns.hasClass('two') ? 2 : 1)) : 1;
    var column_margin = 20;
    var column_width = (box_content.width() - (column_count-1)*column_margin) / column_count;
    var column_height =
      (window_height-10)-
      (box_content.offset().top+box_nav_page.outerHeight()+10);
    var column_min_height = 40;
    var box_content_block = box_content.find('h1, h2, h3, h4, h5, h6, img').css('max-width', column_width);
    for (var i = 0; i < box_content_block.length; i++) {
      column_min_height = Math.max(column_min_height, box_content_block.eq(i).height());
    }
    // Enough space?
    if (column_height >= column_min_height) {
      // Cufon & columnizer IE fix
      box_content.find('cufon').each(function() {
        var height = jQuery(this).parent().height();
        var alt = jQuery(this).attr('alt');
        jQuery(this).parent().css('height', height).append(alt);
        jQuery(this).remove();
      })
      // Preparing content
      box_content.find('th, td').addClass('dontsplit');
      // Settings columns
      box_content
        .css('height', (column_height+10)+'px')
        .find('.columns')
          .css('width', (column_width*2)+'px')
          .columnize({width: column_width, height: column_height, buildOnce: true})
          .css('width', (box.find('.column').length*(column_width+column_margin))+'px')
          .css('position', 'absolute')
          .find('.column.last:empty').remove();
      // Columns pages pagination
      var column_page_count = Math.ceil(box.find('.column').length / column_count);
      var column_page_active = 0;
      if (column_page_count > 1) { 
        box_nav_page.find('.pages')
          .html(strRepeat('<a></a> ', column_page_count))
          .find('a').each(function(i) {
            if (i == 0) jQuery(this).addClass('current');
            jQuery(this).text(i+1);
          });
        box_nav_page.find('a').each(function() {
          jQuery(this).click(function() {
            switch (jQuery(this).attr('class')) {
              case 'next': var num = column_page_active+1; break;
              case 'prev': var num = column_page_active-1; break;
              default:     var num = parseInt(jQuery(this).text())-1;
            }
            if ((num < 0) || (num > column_page_count-1)) return;
            columns.filter(':not(:animated)').animate({left: (-num*(box_content.width()+column_margin))+'px'}, stuff_config.columnPageChangeSpeed, function() {
              box_nav_page.find('.pages a').removeClass('current').eq(num).addClass('current');
              column_page_active = num;
            });
          });
        });
        box_nav_page.css('visibility', 'visible');
      }
      Cufon.replace('.box .content h1, .box .content h2, .box .content h3, .box .content h4, .box .content h5, .box .content h6');
    }
    else {
      box_content.hide();
      box_nav_page.hide();
    }
  }
  
  // Navigation menu
  var nav_menu = jQuery('#nav-menu');
  var nav_menu_ul = nav_menu.find('ul:first');
  var nav_menu_li_height = nav_menu.find('li:first').outerHeight();
  var nav_menu_height = (jQuery('#social-media').hasClass('bottom') ? jQuery('#social-media').offset().top : window_height)-(nav_menu.offset().top+17+10)+13;
  nav_menu_height = Math.max(Math.floor(nav_menu_height / nav_menu_li_height), 1)*nav_menu_li_height;
  nav_menu.css('height', (nav_menu_height-13)+'px'); // -3px-2*5px
  if (nav_menu_height < nav_menu_ul.height())
  {
    nav_menu.find('.arrow').click(function() {
      if (jQuery(this).css('cursor') == 'pointer') {
        var sign = jQuery(this).hasClass('up') ? -1 : 1;
        jQuery('#nav-menu ul:not(:animated)').animate({top: '-='+(nav_menu_height*sign)+'px'}, 'normal', function() {
          var is_up = jQuery(this).position().top < -8;
          var is_down = jQuery(this).position().top+jQuery(this).height() > nav_menu_height;
          if (ie >= 9) {
            jQuery('#nav-menu .arrow.up').stop(true).fadeTo('fast', is_up ? 1 : 0);
            jQuery('#nav-menu .arrow.down').stop(true).fadeTo('fast', is_down ? 1 : 0);
          }
          else {
            jQuery('#nav-menu .arrow.up').css('display', is_up ? 'block' : 'none');
            jQuery('#nav-menu .arrow.down').css('display', is_down ? 'block' : 'none');
          }
          jQuery('#nav-menu .arrow.up').css('cursor', is_up ? 'pointer' : 'default');
          jQuery('#nav-menu .arrow.down').css('cursor', is_down ? 'pointer' : 'default');
        });
      }
    }).hover(function() {
      if (ie >= 9) jQuery('> div', this).stop(true).fadeTo('fast', 1);
      else         jQuery('> div', this).show();
    }, function() {
      if (ie >= 9) jQuery('> div', this).stop(true).fadeTo('fast', 0);
      else         jQuery('> div', this).hide();
    }).filter('.down').show();
  }

  // Vertical centered container
  var container = jQuery('.box.wide:not(.high) .container:not(:has(.thumbnail)):first');
  if (container.length > 0) {
    container.find('.nav-page').hide();
    var top = Math.max(Math.round(stuff_config.middlePoint-container.outerHeight()*0.5), 0);
    var height = container.outerHeight();
    if (height > window_height) {
      container.parent().addClass('high');
      container.css('margin-top', '0px').find('.nav-page').show();
    }
    else {
      container.css('margin-top', (window_height-height < 2*top ? Math.round((window_height-height) / 2) : top)+'px');
    }
  }
  
  // Page anchor scroll
  hash = unescape(self.document.location.hash);
  if (hash) jQuery(window).scrollLeft(jQuery(hash).offset().left-jQuery('#menu').outerWidth());

});