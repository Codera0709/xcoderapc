# Avatar Component

The avatar component displays user profile images or initials with various sizes, shapes, and status indicators.

## Usage

Basic avatar with initials:
```blade
<x-utils.avatar name="John Doe" size="md" />
```

Avatar with image:
```blade
<x-utils.avatar 
    src="https://example.com/avatar.jpg" 
    alt="John's Avatar" 
    size="lg" 
/>
```

Avatar with status:
```blade
<x-utils.avatar 
    name="Jane Smith" 
    size="md" 
    status="online" 
/>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `src` | string | null | URL of the avatar image |
| `alt` | string | 'Avatar' | Alt text for the image |
| `name` | string | null | Name used to generate initials if no image is provided |
| `size` | string | 'md' | Size of the avatar ('xs', 'sm', 'md', 'lg', 'xl') |
| `rounded` | string | 'full' | Shape of the avatar ('none', 'sm', 'md', 'lg', 'xl', 'full') |
| `status` | string | null | User status ('online', 'offline', 'away', 'busy') |
| `border` | boolean | false | Whether to add a border around the avatar |
| `initials` | string | null | Custom initials to display (overrides name) |

## Sizes

- `xs`: 6x6 (text-xs)
- `sm`: 8x8 (text-sm)
- `md`: 10x10 (text-base) - Default
- `lg`: 12x12 (text-lg)
- `xl`: 16x16 (text-xl)

## Status Types

- `online`: Green status indicator
- `offline`: Gray status indicator
- `away`: Yellow status indicator
- `busy`: Red status indicator

## Rounding Options

- `none`: Square avatar
- `sm`: Slightly rounded
- `md`: Moderately rounded
- `lg`: More rounded
- `xl`: Very rounded
- `full`: Circular (default)

## Notes

- If no image is provided, the component generates initials from the name
- Status indicators appear as small circles on the bottom-right of the avatar
- Uses Tailwind CSS for styling
- Fully responsive and works with dark mode
- Accessible with proper alt text