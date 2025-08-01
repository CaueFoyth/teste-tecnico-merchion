export interface User {
  id: number
  name: string
  email: string
  email_verified_at?: string | null
  created_at: string
  updated_at: string
}

export interface RegisterRequest {
  name: string
  email: string
  password: string
}

export interface LoginRequest {
  email: string
  password: string
}

export interface AuthResponse {
  message: string
  user?: User
  status?: string
}

export interface ApiError {
  message: string
  errors?: Record<string, string[]>
}