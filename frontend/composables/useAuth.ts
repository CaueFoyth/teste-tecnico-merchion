import type { User, RegisterRequest, LoginRequest, AuthResponse } from '~/types/user'

export const useAuth = () => {
  const config = useRuntimeConfig()
  const router = useRouter()

  const user = useState<User | null>('auth.user', () => null)
  const isLoggedIn = computed(() => !!user.value)

  const baseConfig = {
    credentials: 'include' as RequestCredentials,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  }

  const handleApiError = (error: any) => {
    const defaultError = {
      message: 'Ocorreu um erro inesperado. Por favor, tente novamente.',
      errors: {},
      statusCode: 500
    }

    if (!error.data || !error.statusCode) {
      throw defaultError
    }

    const errorDetails = {
      message: error.data.message || 'Ocorreu um erro.',
      errors: error.data.errors || {},
      statusCode: error.statusCode
    }

    switch (error.statusCode) {
      case 400:
        errorDetails.message = 'Requisição inválida. Verifique os dados enviados.'
        break
      case 401:
        errorDetails.message = 'Credenciais inválidas. Verifique seu e-mail e senha.'
        break
      case 403:
        errorDetails.message = 'Acesso negado. Você não tem permissão para executar esta ação.'
        break
      case 422:
        errorDetails.message = 'Os dados fornecidos são inválidos. Por favor, verifique os campos do formulário.'
        break
      case 500:
      case 502:
      case 503:
        errorDetails.message = 'Ocorreu um erro no servidor. Por favor, tente novamente mais tarde.'
        break
    }
    throw errorDetails
  }

  const register = async (userData: RegisterRequest): Promise<AuthResponse> => {
    try {
      const response = await $fetch<AuthResponse>('/register', {
        baseURL: config.public.apiBase,
        method: 'POST',
        body: userData,
        ...baseConfig
      })
      await navigateTo('/register-success')
      return response
    } catch (error: any) {
      handleApiError(error)
    }
  }

  const login = async (credentials: LoginRequest) => {
    try {
      const response = await $fetch<AuthResponse>('/login', {
        baseURL: config.public.apiBase,
        method: 'POST',
        body: credentials,
        ...baseConfig
      })
      return await processLoginResponse(response)
    } catch (error: any) {
      user.value = null
      handleApiError(error)
    }
  }

  const processLoginResponse = async (response: any) => {
    let userData: User | null = findUserInObject(response)

    if (userData?.id && userData?.email) {
      user.value = userData
      await router.push('/dashboard')
      return {
        success: true,
        user: userData,
        message: response?.message || 'Login realizado com sucesso'
      }
    } else {
      throw new Error('Dados de usuário não encontrados na resposta do servidor.')
    }
  }

  const findUserInObject = (obj: any): User | null => {
    if (!obj || typeof obj !== 'object') return null
    if (obj.id && obj.email) return obj as User

    for (const value of Object.values(obj)) {
      if (value && typeof value === 'object') {
        const result = findUserInObject(value)
        if (result) return result
      }
    }
    return null
  }

  const logout = async () => {
    try {
      await $fetch('/logout', {
        baseURL: config.public.apiBase,
        method: 'POST',
        ...baseConfig
      })
    } catch (error) {
      // Ignorar erro do servidor no logout, pois não tem essa rota, o importante é deslogar localmente.
    } finally {
      user.value = null
      await router.push('/login')
    }
  }

  const checkAuth = () => {
    return isLoggedIn.value
  }

  return {
    user: readonly(user),
    isLoggedIn,
    register,
    login,
    logout,
    checkAuth
  }
}