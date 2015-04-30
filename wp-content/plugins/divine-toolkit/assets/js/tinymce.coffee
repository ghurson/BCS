(->
  tinymce.PluginManager.add "dvt_shortcode", (editor) ->
    grid = new Array(12)
    grid[0] = "[col col=12]TEXT[/col]<br/>"
    grid[1] = "[col col=6]TEXT[/col]<br/>"
    grid[1] += "[col col=6]TEXT[/col]<br/>"
    grid[2] = "[col col=4]TEXT[/col]<br/>"
    grid[2] += "[col col=4]TEXT[/col]<br/>"
    grid[2] += "[col col=4]TEXT[/col]<br/>"
    grid[3] = "[col col=4]TEXT[/col]<br/>"
    grid[3] += "[col col=8]TEXT[/col]<br/>"
    grid[4] = "[col col=3]TEXT[/col]<br/>"
    grid[4] += "[col col=6]TEXT[/col]<br/>"
    grid[4] += "[col col=3]TEXT[/col]<br/>"
    grid[5] = "[col col=3]TEXT[/col]<br/>"
    grid[5] += "[col col=3]TEXT[/col]<br/>"
    grid[5] += "[col col=3]TEXT[/col]<br/>"
    grid[5] += "[col col=3]TEXT[/col]<br/>"
    grid[6] = "[col col=3]TEXT[/col]<br/>"
    grid[6] += "[col col=9]TEXT[/col]<br/>"
    grid[7] = "[col col=2]TEXT[/col]<br/>"
    grid[7] += "[col col=8]TEXT[/col]<br/>"
    grid[7] += "[col col=2]TEXT[/col]<br/>"
    grid[8] = "[col col=2]TEXT[/col]<br/>"
    grid[8] += "[col col=2]TEXT[/col]<br/>"
    grid[8] += "[col col=2]TEXT[/col]<br/>"
    grid[8] += "[col col=6]TEXT[/col]<br/>"
    grid[9] = "[col col=2]TEXT[/col]<br/>"
    grid[9] += "[col col=2]TEXT[/col]<br/>"
    grid[9] += "[col col=2]TEXT[/col]<br/>"
    grid[9] += "[col col=2]TEXT[/col]<br/>"
    grid[9] += "[col col=2]TEXT[/col]<br/>"
    grid[9] += "[col col=2]TEXT[/col]<br/>"
    grid[10] = "[col col=8]TEXT[/col]<br/>"
    grid[10] += "[col col=4]TEXT[/col]<br/>"
    grid[11] = "[col col=10]TEXT[/col]<br/>"
    grid[11] += "[col col=2]TEXT[/col]<br/>"
    
    grid_icons = new Array("11", "12_12", "13_13_13", "13_23", "14_12_14", "14_14_14_14", "14_34", "16_46_16", "16_16_16_12", "16_16_16_16_16_16", "23_13", "56_16")
    editor.addButton "dvt_shortcode",
      type: "splitbutton"
      title: dvt_vars.i18n.shortcodes
      icon: "dvt_shortcode"
      menu: [
        text: dvt_vars.i18n.grid
        icon: "grid"
        menu: [
          text: "1/1"
          icon: grid_icons[0]
          onclick: ->
            shortcode = "[row]<br/>" + grid[0] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/2 - 1/2"
          icon: grid_icons[1]
          onclick: ->
            shortcode = "[row]<br/>" + grid[1] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/3 - 1/3 - 1/3"
          icon: grid_icons[2]
          onclick: ->
            shortcode = "[row]<br/>" + grid[2] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/3 - 2/3"
          icon: grid_icons[3]
          onclick: ->
            shortcode = "[row]<br/>" + grid[3] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/4 - 1/2 - 1/4"
          icon: grid_icons[4]
          onclick: ->
            shortcode = "[row]<br/>" + grid[4] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/4 - 1/4 - 1/4 - 1/4"
          icon: grid_icons[5]
          onclick: ->
            shortcode = "[row]<br/>" + grid[5] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/4 - 3/4"
          icon: grid_icons[6]
          onclick: ->
            shortcode = "[row]<br/>" + grid[6] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/6 - 4/6 - 1/6"
          icon: grid_icons[7]
          onclick: ->
            shortcode = "[row]<br/>" + grid[7] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/6 - 1/6 - 1/6 - 1/2"
          icon: grid_icons[8]
          onclick: ->
            shortcode = "[row]<br/>" + grid[8] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6"
          icon: grid_icons[9]
          onclick: ->
            shortcode = "[row]<br/>" + grid[9] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "2/3 - 1/3"
          icon: grid_icons[10]
          onclick: ->
            shortcode = "[row]<br/>" + grid[10] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: "5/6 - 1/6"
          icon: grid_icons[11]
          onclick: ->
            shortcode = "[row]<br/>" + grid[11] + "[/row]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
         ]
      ,
        text: dvt_vars.i18n.container
        icon: "container"
        menu: [
          text: dvt_vars.i18n.horizontal_tabs
          icon: "tabs"
          onclick: ->
            shortcode = "[tabs class=\"kopa-tab-widget\"]<br/>"
            shortcode += "[tab title=\"Tab title\"]Tab content[/tab]<br/>"
            shortcode += "[tab title=\"Tab title\"]Tab content[/tab]<br/>"
            shortcode += "[tab title=\"Tab title\"]Tab content[/tab]<br/>"
            shortcode += "[/tabs]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: dvt_vars.i18n.vertical_tabs
          icon: "tabs"
          onclick: ->
            shortcode = "[tabs class=\"kopa-tab-2-widget\"]<br/>"
            shortcode += "[tab title=\"Tab title\"]Tab content[/tab]<br/>"
            shortcode += "[tab title=\"Tab title\"]Tab content[/tab]<br/>"
            shortcode += "[tab title=\"Tab title\"]Tab content[/tab]<br/>"
            shortcode += "[/tabs]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: dvt_vars.i18n.accordion
          icon: "accordion"
          onclick: ->
            shortcode = "[accordions]<br/>"
            shortcode += "[accordion title=\"Accordion title\"]Accordion content[/accordion]<br/>"
            shortcode += "[accordion title=\"Accordion title\"]Accordion content[/accordion]<br/>"
            shortcode += "[accordion title=\"Accordion title\"]Accordion content[/accordion]<br/>"
            shortcode += "[/accordions]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
        ,
          text: dvt_vars.i18n.toggle
          icon: "accordion"
          onclick: ->
            shortcode = "[toggles]<br/>"
            shortcode += "[toggle title=\"Toggle title\"]Toggle content[/toggle]<br/>"
            shortcode += "[toggle title=\"Toggle title\"]Toggle content[/toggle]<br/>"
            shortcode += "[toggle title=\"Toggle title\"]Toggle content[/toggle]<br/>"
            shortcode += "[/toggles]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, shortcode
         ]
      ,
        text: dvt_vars.i18n.video
        icon: "video"
        menu: [
          text: dvt_vars.i18n.youtube
          icon: "youtube"
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[youtube id=\"YOUR_ID\"]"
        ,
          text: dvt_vars.i18n.vimeo
          icon: "vimeo"
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[vimeo id=\"YOUR_ID\"]"
         ]
      ,
        text: dvt_vars.i18n.dropcap
        icon: "dropcap"
        menu: [
          text: dvt_vars.i18n.square
          icon: "square"
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[dropcap class=\"kopa-dropcap dc1\"]" + tinyMCE.activeEditor.selection.getContent() + "[/dropcap]"
        ,
          text: dvt_vars.i18n.circle
          icon: "circle"
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[dropcap class=\"kopa-dropcap dc3\"]" + tinyMCE.activeEditor.selection.getContent() + "[/dropcap]"
        ,
          text: dvt_vars.i18n.solid
          icon: "solid"
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[dropcap class=\"kopa-dropcap dc2\"]" + tinyMCE.activeEditor.selection.getContent() + "[/dropcap]"
         ]
      ,
        text: dvt_vars.i18n.alert
        icon: "alert"
        menu: [
          text: dvt_vars.i18n.info
          icon: 'info'
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[alert class=\"kopa-alert alert-info alert-dismissable\"]" + tinyMCE.activeEditor.selection.getContent() + "[/alert]"
        ,
          text: dvt_vars.i18n.success
          icon: 'success'
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[alert class=\"kopa-alert alert-success alert-dismissable\"]" + tinyMCE.activeEditor.selection.getContent() + "[/alert]"
        ,
          text: dvt_vars.i18n.warning
          icon: 'warning'
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[alert class=\"kopa-alert alert-warning alert-dismissable\"]" + tinyMCE.activeEditor.selection.getContent() + "[/alert]"
        ,
          text: dvt_vars.i18n.danger
          icon: 'danger'
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[alert class=\"kopa-alert alert-danger alert-dismissable\"]" + tinyMCE.activeEditor.selection.getContent() + "[/alert]"
         ]
      ,
        text: dvt_vars.i18n.blockquote
        icon: "blockquote"
        menu: [
          text: dvt_vars.i18n.default
          icon: "blockquote"
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[blockquote class=\"kopa-blockquote\" title=\"The author name\"]" + tinyMCE.activeEditor.selection.getContent() + "[/blockquote]"
        ,
          text: dvt_vars.i18n.without_border
          icon: "blockquote"
          onclick: ->
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[blockquote class=\"kopa-blockquote style-2\" title=\"The author name\"]" + tinyMCE.activeEditor.selection.getContent() + "[/blockquote]"
         ]
      ,
        text: dvt_vars.i18n.button
        icon: "button"
        menu: [
          text: dvt_vars.i18n.style_1
          icon: "button"
          menu: [
            text: dvt_vars.i18n.small
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button small-button color-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
          ,
            text: dvt_vars.i18n.medium
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button medium-button color-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
          ,
            text: dvt_vars.i18n.large
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button big-button color-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
           ]
        ,
          text: dvt_vars.i18n.style_2
          icon: "button"
          menu: [
            text: dvt_vars.i18n.small
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button small-button border-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
          ,
            text: dvt_vars.i18n.medium
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button medium-button border-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
          ,
            text: dvt_vars.i18n.large
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button big-button border-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
           ]
        ,
          text: dvt_vars.i18n.style_3
          icon: "button"
          menu: [
            text: dvt_vars.i18n.small
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button small-button span-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
          ,
            text: dvt_vars.i18n.medium
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button medium-button span-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
          ,
            text: dvt_vars.i18n.large
            icon: "button"
            onclick: ->
              tinyMCE.activeEditor.execCommand "mceInsertContent", 0, "[button class=\"kopa-button big-button span-button\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/button]"
           ]
         ]
      ,
        text: dvt_vars.i18n.pricing_table
        icon: "pricing"
        menu: [
          text: dvt_vars.i18n.default
          icon: "pricing"
          onclick: ->
            html = "[pricing_table class=\"\"]<br/>"
            html += "[pt_caption]YOUR_CAPTION[/pt_caption]<br/>"
            html += "[pt_price prefix=\"YOUR_PRICE_PREFIX\"]YOUR_PRICE[/pt_price]<br/>"
            html += "[pt_featured]YOUR_FEATURED_1[/pt_featured]<br/>"
            html += "[pt_featured]YOUR_FEATURED_2[/pt_featured]<br/>"
            html += "[pt_featured]YOUR_FEATURED_3[/pt_featured]<br/>"
            html += "[pt_featured]YOUR_FEATURED_4[/pt_featured]<br/>"
            html += "[pt_button url=\"YOUR_BUTTON_URL\" target=\"\"]YOUR_BUTTON_TEXT[/pt_button]<br/>"
            html += "[/pricing_table]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, html
        ,
          text: dvt_vars.i18n.special
          icon: "pricing"
          onclick: ->
            html = "[pricing_table class=\"active\"]<br/>"
            html += "[pt_caption]YOUR_CAPTION[/pt_caption]<br/>"
            html += "[pt_price prefix=\"YOUR_PRICE_PREFIX\"]YOUR_PRICE[/pt_price]<br/>"
            html += "[pt_featured]YOUR_FEATURED_1[/pt_featured]<br/>"
            html += "[pt_featured]YOUR_FEATURED_2[/pt_featured]<br/>"
            html += "[pt_featured]YOUR_FEATURED_3[/pt_featured]<br/>"
            html += "[pt_featured]YOUR_FEATURED_4[/pt_featured]<br/>"
            html += "[pt_button url=\"YOUR_BUTTON_URL\" target=\"\"]YOUR_BUTTON_TEXT[/pt_button]<br/>"
            html += "[/pricing_table]<br/>"
            tinyMCE.activeEditor.execCommand "mceInsertContent", 0, html
         ]
      ,
        text: dvt_vars.i18n.list
        icon: "list"
        onclick: ->
          html = "[list]<br/>"
          html += "[item class=\"fa fa-check\"]YOUR_CONTENT[/item]<br/>"
          html += "[item class=\"fa fa-check\"]YOUR_CONTENT[/item]<br/>"
          html += "[item class=\"fa fa-check\"]YOUR_CONTENT[/item]<br/>"
          html += "[item class=\"fa fa-check\"]YOUR_CONTENT[/item]<br/>"
          html += "[item class=\"fa fa-check\"]YOUR_CONTENT[/item]<br/>"
          html += "[/list]<br/>"
          tinyMCE.activeEditor.execCommand "mceInsertContent", 0, html
        ,
        text: dvt_vars.i18n.contact
        icon: "contact"
        onclick: ->
          tinyMCE.activeEditor.execCommand "mceInsertContent", 0, '[contact_form]'             
       ]  
)()