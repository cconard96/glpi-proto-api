# New GLPI API System Prototype
This GLPI plugin is a prototype replacement API system derived from the OIMC project by CJ Development Studios.
OIMC (Open IT Management Center) is a platform and abstraction layer for IT-related software.

Implemented:
- Any request to /plugins/api will list all available API versions, and their related information.
  ```JSON
  [
    {"apiVersion":1,"version":"1.0.0","endpoint":"v1"},
    {"apiVersion":2,"version":"2.0.0","endpoint":"v2"}
  ]
  ```
- Any request to the v1 endpoint (known by checking the return from /plugins/api to be /plugins/api/v1) will be redirected to the old apirest.php entrypoint as-is.

Advantages over legacy API:
- Uses modern Symfony components such as routing to simplify request handling
  - Symfony provides a solid platform for adding functionality using existing Symfony bundles such as adding OAuth 2.0 authentication for API access
- The API is versioned so major/breaking changes can be done in a new version without breaking existing scripts
  - Multiple versions can be supported at the same time