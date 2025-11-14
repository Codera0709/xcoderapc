# Input Component

The input component is a reusable form element that provides consistent styling and functionality with support for labels, validation, icons, and various input types.

## Usage

```blade
<x-form.input 
    name="email" 
    type="email" 
    label="Email Address" 
    placeholder="Enter your email"
    required
/>
```

With icon:
```blade
<x-form.input 
    name="search" 
    label="Search" 
    placeholder="Search items..."
    icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>'
/>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `type` | string | 'text' | Input type (text, email, password, number, date, etc.) |
| `name` | string | '' | Name attribute for the input |
| `id` | string | '' | ID attribute for the input (auto-generated from name if not provided) |
| `value` | string | '' | Initial value of the input |
| `placeholder` | string | '' | Placeholder text |
| `label` | string | '' | Label text displayed above the input |
| `helper` | string | '' | Helper text displayed below the input |
| `required` | boolean | false | Whether the field is required |
| `disabled` | boolean | false | Whether the field is disabled |
| `readonly` | boolean | false | Whether the field is read-only |
| `error` | string | '' | Error message to display (takes precedence over validation errors) |
| `icon` | string | '' | SVG icon to display inside the input |
| `iconPosition` | string | 'left' | Position of the icon ('left' or 'right') |

## Validation

The component automatically detects Laravel validation errors using the `$errors` variable. If there are validation errors for the input's name, it will show the error message and apply appropriate styling.

## Styling

- Uses Tailwind CSS for styling
- Responsive design that works on all screen sizes
- Dark mode support
- Visual feedback for different states (focus, error, disabled)

## Notes

- The component includes proper accessibility attributes (labels, IDs)
- Supports all HTML5 input types
- Automatically integrates with Laravel's validation system
- Includes visual feedback for different input states