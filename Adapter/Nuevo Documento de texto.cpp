#include <iostream>
#include <string>
#include <algorithm>

using namespace std;

/**
 * Target define la interfaz específica del dominio utilizada por el código del cliente.
 */
class Target {
 public:
  virtual ~Target() = default;

  virtual string Request() const {
    return "Target: Comportamiento predeterminado del objetivo.";
  }
};

/**
 * Adaptee contiene algún comportamiento útil, pero su interfaz es incompatible
 * con el código del cliente existente. Adaptee necesita alguna adaptación antes de que
 * el código del cliente pueda usarlo.
 */
class Adaptee {
 public:
  string SpecificRequest() const {
    return ".eetpadA eht fo roivaheb laicepS";
  }
};

/**
 * Adapter hace que la interfaz de Adaptee sea compatible con la interfaz de Target.
 */
class Adapter : public Target {
 private:
  Adaptee *adaptee_;

 public:
  Adapter(Adaptee *adaptee) : adaptee_(adaptee) {}
  string Request() const override {
    string to_reverse = this->adaptee_->SpecificRequest();
    reverse(to_reverse.begin(), to_reverse.end());
    return "Adapter: (TRADUCIDO) " + to_reverse;
  }
};

/**
 * El código del cliente admite todas las clases que siguen la interfaz de Target.
 */
void ClientCode(const Target *target) {
  cout << target->Request();
}

int main() {
  cout << "Cliente: Puedo trabajar muy bien con objetos Target:\n";
  Target *target = new Target;
  ClientCode(target);
  cout << "\n\n";
  Adaptee *adaptee = new Adaptee;
  cout << "Cliente: La clase Adaptee tiene una interfaz extraña. Mira, no la entiendo:\n";
  cout << "Adaptee: " << adaptee->SpecificRequest();
  cout << "\n\n";
  cout << "Cliente: Pero puedo trabajar con ella a través del Adaptador:\n";
  Adapter *adapter = new Adapter(adaptee);
  ClientCode(adapter);
  cout << "\n";

  delete target;
  delete adaptee;
  delete adapter;

  return 0;
}
