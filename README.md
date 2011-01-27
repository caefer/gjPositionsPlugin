# gjPositionsPlugin - visual page composition

## About

Many websites - _especially those driven by editorial content_ - have one or more aggregation pages like home pages, index pages, category pages and so on. Their purpose is to aggregate the underlying contents often with the latest contents on top but also you often find contents listed manually by an editor using some kind of administration tool.

The difficulty is that the underlying contents can be of various types like articles, galleries, videos, quizes, etc. .. Most of these contents will have their own custom visualisation as i.e. a gallery will render differently than an article.

gjPositionsPlugin provides means to compose such aggregation pages from a flexible list of design elements such as slideshows or teasers and to manually assign any type of content to them.

This functionality is provided in form of admin modules that you can generate for any of your models (in case a home page and an index page are not the same).

## Installation

Currently you can only get this plugin from GitHub. It is still highly experimental and will change.

    $ cd plugins
    $ git clone git://github.com/caefer/gjPositionsPlugin.git

This plugin depends on my fork of sfDoctrineDynamicFormRelationsPlugin which is originally developed by Kris Wallsmith. A pull request is issued already so hopefully both versions can be merged again.

    $ cd plugins
    $ git clone git://github.com/caefer/sfDoctrineDynamicFormRelationsPlugin.git

Then edit your ProjectConfiguration class and enable the plugins.

    <?php

    require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
    sfCoreAutoload::register();

    class ProjectConfiguration extends sfProjectConfiguration
    {
      public function setup()
      {
        $this->enablePlugins('sfDoctrinePlugin');
        $this->enablePlugins('gjPositionsPlugin');
        $this->enablePlugins('sfDoctrineDynamicFormRelationsPlugin');
      }
    }

Next you need to publish the plugins assets by running the following.

    $ php symfony plugin:publish-assets

## Additional Requirements

Please note that gjPositionsPlugin requires jQuery and jQuery UI. It was tested with jQuery version 1.4.2 (jquery-1.4.2.min.js) and jQuery UI version 1.8.6 (jquery-ui-1.8.6.min.js). Both files have to be loaded for the admin module to work!

## Term Definition

<dl>
  <dt>Composition Canvas</dt>
  <dd>The <em>Composition Canvas</em> is a space inside the generated admin module. You can drop multiple <em>Design Elements</em> onto it, reorder or delete them. When rendering you record you can access these design elments through a relation and render them accordingly.</dd>
  <dt>Design Element</dt>
  <dd>A <em>Design Element</em> is a partial or component plus some settings in your app.yml. <em>DesignElements</em> are developed by yourself according to your requirements. <em>Design Elements</em> can be static (partials) or dynamic (components) and they can be parameterized with settings you define and they can have <em>Content Elements</em> assigned to them.</dd>
  <dt>Content Element</dt>
  <dd><em>Content Elements</em> are placeholders for a single record of any of your models. They represent the relation between a content record and a <em>Design Element</em>.</dd>
</dl>

## Usage

To get started you have to follow these following steps.

### 1. Make any one of your models act as a composition

Assuming you have a model called `Homepage` you simply have to add the `gjCompositionCanvas` behaviour to its schema definition.

    Homepage:
      actAs:
        Timestampable:        ~
        gjCompositionCanvas:  ~
      columns:
        title:                string(255)
        headline:             string(255)
    ...

### 2. Develop as many _Design Elements_ as you want

This one is totally up to you! A _Design Element_ can be anything from a simple `partial` template to a complex component implementing business logic. The only thing you have to regard is that the only the following parameters will be passed to your partial/component:

1. `params` is an array of settings saved for this _Design Element_. You will see in a moment how this can be done.
2. `subject` is the instance of your composition model (i.e. `Homepage`) that this _Design Element_ is assigned to.
2. `contents` is a list of _Content Elements_ that were manually assigned to the _Design Element_.

### 3. Configure your _Design Elements_ to be used in the generated admin module

Lets assume you wrote a simple partial `yourmodule/banner` that renders a bit of HTML and contains no other PHP _(more complex examples will follow later in this document)_.

    all:
      gjPositionsPlugin:
        design_elements:
          banner:
            description:      "This is a simple banner"
            applies_to:       [ Homepage ]
            include:          "yourmodule/banner"
            accept:           ~
            params:           ~

With these settings you defined a _Design Element_ called _banner_ that can be assigned to a `Homepage` and will render the partial `yourmodule/banner`.

If you want to provide a little business logic you may prefer a component. Here is what the settings would look like.

    all:
      gjPositionsPlugin:
        design_elements:
          banner:
            description:      "This is a simple banner"
            applies_to:       [ Homepage ]
            include:          [ yourmodule, banner ] // for a component you provide an array
            accept:           ~
            params:           ~

_The other settings will be explained further on._

### 4. Generate your admin module using the _composition theme_

You simply generate an admin module for your `Homepage` model with the symfony/doctrine admin generator.

    $ php symfony doctrine:generate-admin --theme=composition frontend Homepage

The only difference is that you use the _composition theme_ provided by gjPositionsPlugin.

Now browse to your freshly generated admin module and take a look. You will see that the edit view of your admin module consists of three columns.

* The left one displays the form for your `Homepage and also holds the _Composition Canvas_.
* The center column displays all _Design Elements_ that can be applied to a `Homepage`
* The left column displays _Content Elements_ which we haven not used so far.

### 5. Render _Design Elements_ assigned to your `Homepage`

You don't have to change anything in your action so it might look as simple as this.

    public function executeIndex(sfWebRequest $request)
    {
      $id = $request->getParameter('id');
      $this->forward404unless($id);
      $this->homepage = Doctrine_Core::getTable('Homepage')->find($id);
    }

The interesting part happens in the template.

    <?php use_helper('gjPositions') ?>
    ...
    <?php foreach($page['DesignElements'] as $name => $designElement): ?>
      <?php include_design_element($designElement); ?>
    <?php endforeach; ?>
    ...

Through the `DesingElements` relation you can simply iterate of all _Design Elements_ that you have assigned to this `Homepage` in the admin module. The gjPositions`Helper`provides a helper function `include_design_element()` which merges the _Design Element_ with the settings from your `app.yml` and returns either an `include_partial()` or `include_component()`.

---

And that's all there is to it to be able to compose a `Homepage` from various _Design Elements_.

## Advanced Usage

But of course there is more to it!

### 1. Limiting the use of _Desing Elements_ to specific models

If make heavy use of gjPositionsPlugin and turned multiple models into _Composition Canvases_ you might find the situation that some _Design Elements_ are not suitable for all _Composition Canvases_.

I.e. a `contactform` might be only suitable for a `Sidebar`but not for a `Homepage`. 

Taking the above example the following settings will limit the use of a `banner` to only `Homepages` and `Sidebars`.

    all:
      gjPositionsPlugin:
        design_elements:
          banner:
            description:      "This is a simple banner"
            applies_to:       [ Homepage, Sidebar ]
            include:          [ yourmodule, banner ]
            accept:           ~
            params:           ~

### 2. Parameterizing _Desing Elements_

With all the above you would be able to implement for example a _Design Element_ that displays the _latest articles_ that have been created in your database. This would be a simple component that fetches a number of articles from the database and renders them in a list in its partial template.

You can use this one _Design Element_ on all your `Homepages`. But you might want to filter the articles for a section homepage to show only those related to this section? Or you might want to list the latest 20 articles on your homepage but only 10 on your section homepage?

For this you can configure parameters on _Design Elements_ like the following.

    all:
      gjPositionsPlugin:
        design_elements:
          latestArticles:
            description:      "Shows the latest articles"
            applies_to:       [ Homepage ]
            include:          [ article, latest ]
            accept:           ~
            params:
              number:         { type: text, default: "5" }
              section_id:     { type: text, default: false }

These above settings will result in two more input fields on the _Design Element_ in your admin module. They can be edited per assignation.

All types of `<input/>` tags are available but probably only a few like `text`, `checkbox` or `radio` make sense.

The values of these parameters will be available in your component and/or partial.

    // in your component
    ...
    $this->articles = Doctrine_Query::create()
      ->from('Article a')
      ->orderBy('a.created_at DESC')
      ->limit($this->params['number'])
      ->execute();
    ...

    // in your partial
    ...
    <?php for($i=0; $i < $params['number']; $i++): ?>
      ...
    <?php endfor; ?>
    ...

### 3. Manually assigning _Content Elements_ to _Design Elements_

Another form of parameterisation but with added usability is the assignment of _Content Elements_ to a _Design Element_.

To give you an example you might want to show a _Design Element_ "slideshow" on the top of your `homepage` but you want to assign the images manually.

Lets prepare the `Image` model first.

    Image:
      actAs:
        gjCompositionContent: ~
      columns:
        title: string(255)
        file:  string(255)
        ...

After you regenerated the model classes you `Image` will have a relation to the _Content Elements_ (`gjContentElement`) which are loosely coupled to it. No extra fields will be added.

Then you implement a _slideshow_ component in your "gallery" module that expects a number of images to be displayed in a loop (i.e. using a jQuery plugin). Configure it like this.

    all:
      gjPositionsPlugin:
        design_elements:
          slideshow:
            description:      "Shows a slideshow of manually assigned images"
            applies_to:       [ Homepage ]
            include:          [ gallery, slideshow ]
            accept:           [ Image ]
            params:           ~

Now in your component and partial template you can access the list of all assigned content elements.

    // in your component
    ...
    foreach($this->contents as $content)
    {
      ...
    }
    ...

    // in your partial
    ...
    <?php foreach($contents as $content): ?>
      ...
    <?php endforeach; ?>
    ...

Each content will be of type `gjContentElement` on which the original content (in this case an `Image` object) is available throught the `getObject()` method. So you can do the following.

    // in your partial
    ...
    <?php foreach($contents as $content): ?>
      <?php $image = $content->getObject(); ?>
      <?php echo image_tag($image->file, array('title' => $image->title)); ?>
    <?php endforeach; ?>
    ...

### 4. Optimizing Performance of the Admin Module

When you created your admin module symfony added an sfDoctrineRouteCollection to your applications `routing.yml` like this.

    homepage:
      class: sfDoctrineRouteCollection
      options:
        model:                Homepage
        module:               homepage
        prefix_path:          /homepage
        column:               id
        with_wildcard_routes: true

As the composition admin module will contain a lot of informations it will issue a lot of queries to your database because all relations are by default lazy loaded which will happen for each and every iteration on the page.

To reduce the number of queries to a minimum you simply have to add two more lines to the above route definition so it looks like this.

    homepage:
      class: sfDoctrineRouteCollection
      options:
        model:                Homepage
        module:               homepage
        prefix_path:          /homepage
        column:               id
        with_wildcard_routes: true
        model_methods:
          object:             getObject

This will add all appropriate `left joins` to the queries which will in effect avoid a lot of similar queries.

### 5. Enabling composition in an already existing admin module

When introducing gjPositionsPlugin to an existing project chances are that you are not able to regenerate your admin modules as you have already made some modifications to it. So instead there needs to be a way to adapt this functionality without loosing your old work.

You can do this in three simple steps.

#### 1. Create a Components Class

In your admin module you have to create the file `components.class.php` just next to your `actions.class.php` in the `actions` folder.

    <?php
    
    require_once sfConfig::get('sf_module_cache_dir').'/auto'.ucfirst('demo_page').'/actions/components.class.php';
    
    /**
     * demo_page components.
     *
     * @package    positionsdemo
     * @subpackage demo_page
     * @author     Your name here
     * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
     */
    class demo_pageComponents extends autoDemo_pageComponents
    {
    }

> The above assumes the name `demo_page` for your module and you have to replace it with the real name.

#### 2. Configure the Theme

Open your `generator.yml` and change the `theme` to "_composition_".

    generator:
      class: sfDoctrineGenerator
      param:
        model_class:           DemoPage
        theme:                 composition
        non_verbose_templates: true
        with_show:             false
        singular:              ~
        plural:                ~
        route_prefix:          demo_page
        with_doctrine_route:   true
        actions_base_class:    sfActions
    
        config:
          actions: ~
          fields:  ~
          list:    ~
          filter:  ~
          form:    ~
          edit:    ~
          new:     ~

#### 3. Clear the Cache

Now what's left is to clear the cache in order for the admin generator to generate the module from scratch in your cache directory.

    $ php symfony cc

### 6. Overriding values of a content per placement (content element)

This plugin helps you i.e. to place articles (as a _Content Element_)on a homepage together with other _Design Elements_.
Sometimes it may be useful to be able to overload specific fields of an article.

For SEO reasons it is often required for articles to show up with a different headline on an overview page that they have on their detail page.

Imagine the following schema:

    Article:
      actAs:
        gjCompositionContent: ~
      columns:
        title: string(255)
        text:  string(10000)
        ...

To be able to override the `title` field individually for each "placement" you can extend the above schema like the following:

    Article:
      actAs:
        gjCompositionContent:
          override: [ title ]
      columns:
        title: string(255)
        text:  string(10000)
        ...

By passing the `override` option to the `gjCompositionContent` behaviour you can specify an array of fieldnames you want to be able to override.

Now each _Content Element_ holding an `Article` will present an input field in your admin module.

In your template displaying the `title` you can now define a fallback mechanism like this:

    ...
    <?php echo $content['override']['title'] ? $content['override']['title'] : $content['Object']['title'] ?>
    ...

This will prefer the overriden over the original title. If no override was specified then the original will be displayed.

