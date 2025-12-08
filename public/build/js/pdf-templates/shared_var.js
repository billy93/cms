// Shared variables and constants for PDF Templates module

// API endpoints
const PDF_TEMPLATE_API = {
  INDEX: $('#template_list').data('url'),
  CREATE: '/pdf-templates',
  READ: (id) => `/pdf-templates/${id}`,
  UPDATE: (id) => `/pdf-templates/${id}`,
  DELETE: (id) => `/pdf-templates/${id}`,
  PREVIEW: '/pdf-templates/preview'
};

// DataTable instance
let templateDataTable = null;

// Current filter type
let currentFilterType = '';
