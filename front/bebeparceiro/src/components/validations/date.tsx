'use client';
import { z } from 'zod';
import ValidationResult from '../types';

const dateValidatorSchema = z
    .string({ required_error: 'Data é obrigatória', })
    .refine(
        (value) => /^\d{2}\/\d{2}\/\d{4}$/.test(value),
        { message: 'Data Inválida', })
    .refine(
        (value) => {
            // O formato é dd/mm/yyy
            let date = new Date(value.split('/').reverse().join('-'));
            return !isNaN(date.getTime());
        },
        { message: 'Data Inválida', });

export function dateValidator(date: string): ValidationResult {
    console.log("Validando data: ", date);
    let result = dateValidatorSchema.safeParse(date);
    console.log("Resultado da validação: ", result);
    return { 
        isValid: result.success, 
        message: result.error?.issues[0].message ?? '',
    };
}