# ASFWebsiteBundle Configuration Reference

## Default configurations

```yaml
asf_website:
    form_theme: ASFWebsiteBundle:Form:fields.html.twig
    config:
        form:
            type: ASF\WebsiteBundle\Form\Type\ConfigType
            name: website_config_type
    parameter:
        form:
            type: ASF\WebsiteBundle\Form\Type\ParameterType
            name: website_parameter_type
```