# gjPositionsPlugin - visual page composition

## About

## Installation

Currently you can only get this plugin from GitHub. It is still highly experimental and will change.

    $ cd plugins
    $ git clone git://github.com/caefer/gjPositionsPlugin.git

Then edit your ProjectConfiguration class and enable the plugin.

## Usage

gjPositionsPlugin basically consists of two doctrine behaviours and a symfony admin generator theme. You have to use all three to gain full functionality.

Suppose you want to compose a page and include Articles and FAQs on it.

    Page:
      actAs:   [gjCompositionCanvas]
      columns:
        title: string(255)
        ...

    Article:
      actAs:
        LooselyCoupled:
          ContentElement: gjContentElement
        title: string(255)
        ...

    FAQ:
      actAs:
        LooselyCoupled:
          ContentElement: gjContentElement
        title: string(255)
        ...

 Now that you have prepared your Models you can generate a new admin module for your Page objects.

    $ php symfony doctrine:generate-adminn --theme=composition --module=composition frontend Page

Now you have a new admin modules with composition features.

## TODO

* write more documentation
