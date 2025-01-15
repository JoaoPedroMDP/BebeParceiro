'use client';
import { z } from 'zod';
import ValidationResult from '../types';

const phoneValidatorSchema = z
    .string({ required_error: 'Celular é obrigatório', })
    .refine(
        (value) => /^\+?\(\d{2}\) \d{5}-\d{4}$/.test(value),
        { message: 'Número Inválido', })

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