'use client';
import { z } from 'zod';
import ValidationResult from '../types/validationResult';

const phoneValidatorSchema = z
    .string({ required_error: 'Celular é obrigatório', })
    .refine(
        (value) => /^\+?\d+$/.test(value),
        { message: 'Número Inválido', })
    .refine(
        (value) => value.length >= 10 && value.length <= 11,
        { message: 'Telefone deve conter 10 ou 11 dígitos', });

export function phoneValidator(phone: string): ValidationResult {
    console.log("Validando telefone: ", phone);
    let result = phoneValidatorSchema.safeParse(phone);
    console.log("Resultado da validação: ", result);
    return { 
        isValid: result.success, 
        message: result.error?.issues[0].message ?? '',
    };
}

export type Phone = z.infer<typeof phoneValidatorSchema>;