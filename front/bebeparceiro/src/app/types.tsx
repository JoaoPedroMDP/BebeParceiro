interface ValidationResult {
    isValid: boolean;
    message: string;
}

interface SelectOption {
    value: string;
    label: string;
}

export type { ValidationResult, SelectOption };