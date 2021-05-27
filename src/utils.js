export const toDashCase = camelCase =>
  camelCase
    .split(/(?=[A-Z])/)
    .join('-')
    .toLowerCase()
