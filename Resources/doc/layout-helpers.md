# ASFWebsiteBundle Layout Helpers

The layout helpers are a set of Twig functions to get website configuration parameters.

For configure dynamically generic parameters like metas of your website, you can create this parameters with Config Entity and Parameter Entity.

A Config is a set of parameters that you can define has default configuration for your website.

Suppose you create a default configuration called *default-website-config* with two parameters : *meta-title-suffix* and *meta-title-description*.

After add this configuration and parameters in your backend, for retrieve it in your frontend temaplte, you have to call a Twig function *asf_get_param()* with this options :

* *asf_get_param('meta-title-suffix')* : Get the parameter *meta-title-suffix* from the configuration marked has default
* *asf_get_param('meta-title-suffix', 'second-config')* : Get the parameter *meta-title-suffix* from another configuration
* *asf_get_param('meta-title-suffix', 'second-config', true)* : The last parameter is for set debug mode who raise Exception if no parameter or no configuration found.

For further informations about Config entity and Parameter entity, see [ASFWebsiteBundle Entities][1].

[1]: entities.md