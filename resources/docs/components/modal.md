# Modal Component

The modal component is a reusable UI element for displaying content in a floating overlay.

## Usage

```blade
<x-ui.modal name="my-modal" title="Modal Title" size="md">
    <p>This is the modal content.</p>
    
    <x-slot name="footer">
        <div class="flex justify-end space-x-2">
            <x-ui.button variant="secondary" @click="$dispatch('close-modal', 'my-modal')">
                Cancel
            </x-ui.button>
            <x-ui.button variant="primary">
                Confirm
            </x-ui.button>
        </div>
    </x-slot>
</x-ui.modal>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | 'modal' | Unique name for the modal to be used with Alpine.js events |
| `show` | boolean | false | Whether the modal should be visible by default |
| `maxWidth` | string | 'md' | Size of the modal ('sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl') |
| `title` | string | null | Title text to display in the modal header |

## Events

- `open-modal`: Dispatch this event to open the modal: `$dispatch('open-modal', 'modal-name')`
- `close-modal`: Dispatch this event to close the modal: `$dispatch('close-modal', 'modal-name')`

## Slots

- `default`: Main content of the modal
- `footer`: Optional footer content (useful for action buttons)

## Notes

- The modal uses Alpine.js for state management
- The modal can be closed by clicking on the backdrop or pressing the ESC key
- The component includes smooth transitions for better UX