# Button Component

The button component is a versatile UI element with multiple variants, sizes, and states to handle various use cases in the application.

## Usage

Basic button:
```blade
<x-ui.button variant="primary">
    Click me
</x-ui.button>
```

Button with icon:
```blade
<x-ui.button 
    variant="primary" 
    icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>'
>
    Add User
</x-ui.button>
```

Button with loading state:
```blade
<x-ui.button 
    variant="primary" 
    :loading="true"
    :disabled="true"
>
    Processing...
</x-ui.button>
```

Link button:
```blade
<x-ui.button 
    variant="secondary" 
    :href="route('users.index')"
>
    Back to Users
</x-ui.button>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | string | 'primary' | Visual style ('primary', 'secondary', 'success', 'danger', 'warning', 'info', 'outline', 'ghost') |
| `size` | string | 'md' | Size of the button ('xs', 'sm', 'md', 'lg', 'xl') |
| `loading` | boolean | false | Whether to show loading spinner and disable interaction |
| `disabled` | boolean | false | Whether to disable the button |
| `type` | string | 'button' | HTML button type ('button', 'submit', 'reset') |
| `href` | string | null | If provided, renders as an anchor tag instead of button |
| `icon` | string | null | SVG icon to display inside the button |

## Variants

- `primary`: Primary action button with indigo background
- `secondary`: Secondary action with gray background
- `success`: Success/positive action with green background
- `danger`: Destructive action with red background
- `warning`: Warning action with yellow background
- `info`: Informational action with blue background
- `outline`: Outlined button with border
- `ghost`: Minimal styling button

## Sizes

- `xs`: Extra small button
- `sm`: Small button
- `md`: Medium button (default)
- `lg`: Large button
- `xl`: Extra large button

## States

The button automatically handles various states:
- Hover: Applies hover color variants
- Focus: Shows focus ring
- Disabled: Shows disabled state with reduced opacity
- Loading: Shows spinner and prevents interaction

## Notes

- The component uses Tailwind CSS for styling
- Includes proper focus management for accessibility
- Supports both button and anchor tag rendering
- Includes loading state with spinner animation
- Fully responsive and works with dark mode